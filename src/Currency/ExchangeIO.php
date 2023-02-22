<?php

namespace Sidspears\Tax\Currency;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;

class ExchangeIO implements CurrencyResource
{
    protected $endpoint = "https://api.exchangeratesapi.io/latest";
    private HttpClient $client;

    public function __construct()
    {
        $client = HttpClient::create();

        $this->client = $client->withOptions([
            'base_uri' => $this->endpoint,
        ]);
    }

    public function currency(string $from, string $to): float
    {
        try {
            return $this->client->request('GET', "currency", [
                'query' => [
                    'from' => $from,
                    'to' => $to
                ]
            ]);
        } catch (HttpExceptionInterface $e) {
            throw $e;
        }
    }
}
