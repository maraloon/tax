<?php

namespace Sidspears\Tax\Bin;

use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Component\HttpClient\HttpClient;

class BinListApi implements CountryByBinResource
{
    protected $endpoint = "https://api.binlist.io";
    private HttpClient $client;

    public function __construct()
    {
        $client = HttpClient::create();

        $this->client = $client->withOptions([
            'base_uri' => $this->endpoint,
        ]);
    }

    public function country(int $bin): string
    {
        try {
            return $this->client->request('GET', "bin", [
                'query' => [
                    'bin' => $bin,
                ]
            ]);
        } catch (HttpExceptionInterface $e) {
            throw $e;
        }
    }
}
