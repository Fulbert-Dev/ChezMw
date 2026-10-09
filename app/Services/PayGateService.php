<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayGateService
{
    public function isConfigured(): bool
    {
        $token = trim((string) config('services.paygate.token'));

        return $token !== '' && ! str_contains(strtoupper($token), 'NOUVELLE_CLE');
    }

    public function phoneMatchesNetwork(string $phone, string $network): bool
    {
        $phone = preg_replace('/^\+228/', '', str_replace(' ', '', $phone));
        $network = strtolower($network);
        $prefixes = config("services.paygate.network_prefixes.{$network}", []);

        foreach ($prefixes as $prefix) {
            if (str_starts_with($phone, $prefix)) {
                return true;
            }
        }

        return false;
    }

    public function networkForPhone(string $phone): ?string
    {
        foreach (array_keys((array) config('services.paygate.network_prefixes', [])) as $network) {
            if ($this->phoneMatchesNetwork($phone, $network)) {
                return $network;
            }
        }

        return null;
    }

    public function paymentUrl(
        int $amount,
        string $identifier,
        ?string $description = null,
        ?string $network = null,
        ?string $phone = null
    ): string {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('La clé API PayGate n’est pas configurée.');
        }

        return $this->pageUrl($amount, $identifier, $description, $phone, $network);
    }

    public function pageUrl(
        int $amount,
        string $identifier,
        ?string $description = null,
        ?string $phone = null,
        ?string $network = null
    ): string {
        $params = [
            'token' => config('services.paygate.token'),
            'amount' => $amount,
            'identifier' => $identifier,
            'url' => route('paygate.return'),
        ];

        if ($network) {
            $params['network'] = strtoupper($network);
        }

        if ($description) {
            $params['description'] = $description;
        }

        if ($phone) {
            $params['phone'] = $phone;
        }

        return config('services.paygate.page_url')
            .'?'.http_build_query($params);
    }

    public function statusByIdentifier(string $identifier)
    {
        return Http::acceptJson()
            ->timeout(10)
            ->retry(2, 250)
            ->post(
                config('services.paygate.status_identifier_url'),
                [
                    'auth_token' => config('services.paygate.token'),
                    'identifier' => $identifier,
                ]
            );
    }

    public function statusByTransactionReference(
        string $txReference
    ) {
        return Http::acceptJson()
            ->timeout(10)
            ->retry(2, 250)
            ->post(
                config('services.paygate.status_url'),
                [
                    'auth_token' => config('services.paygate.token'),
                    'tx_reference' => $txReference,
                ]
            );
    }

    public function isSuccessful($response): bool
    {
        if (! $response->successful()) {
            return false;
        }

        $payload = $response->json();
        $status = data_get($payload, 'status')
            ?? data_get($payload, 'data.status')
            ?? data_get($payload, 'payment_status')
            ?? data_get($payload, 'data.payment_status');

        return in_array(strtolower((string) $status), [
            'success', 'successful', 'completed', 'paid', 'paye', 'approved', '00', '200',
        ], true);
    }

    public function transactionReference($response): ?string
    {
        $payload = $response->json();

        return data_get($payload, 'tx_reference')
            ?? data_get($payload, 'data.tx_reference')
            ?? data_get($payload, 'transaction_reference')
            ?? data_get($payload, 'data.transaction_reference');
    }

    public function responseMatchesPayment($response, int $amount, string $identifier): bool
    {
        $payload = $response->json();
        $returnedIdentifier = data_get($payload, 'identifier')
            ?? data_get($payload, 'data.identifier');
        $returnedAmount = data_get($payload, 'amount')
            ?? data_get($payload, 'data.amount')
            ?? data_get($payload, 'payment_amount')
            ?? data_get($payload, 'data.payment_amount');

        if ($returnedIdentifier !== null && (string) $returnedIdentifier !== $identifier) {
            return false;
        }

        return $returnedAmount === null
            || (float) $returnedAmount === (float) $amount;
    }
}
