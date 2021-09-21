<?php

namespace Devgleb\CoinMarketCap;

use Devgleb\CoinMarketCap\Api\Cryptocurrency;
use Devgleb\CoinMarketCap\Api\Fiat;
use Devgleb\CoinMarketCap\Api\Key;
use Devgleb\CoinMarketCap\Api\Tools;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class CoinMarketCap {

    protected const BASE_URI = 'https://pro-api.coinmarketcap.com/';

    private $httpClient;
    private $apiKey = '';

    public function __construct($apiKey, $httpClient = null)
    {
        if (!is_string($apiKey) || empty($apiKey)) {
            throw new \InvalidArgumentException("You must provide an API key.");
        }

        $this->apiKey = $apiKey;

        $this->httpClient = $httpClient ?: new Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * Sets the API Key.
     *
     * @param string $apiKey API key for the CoinMarketCap account.
     * @api
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Returns the API Key.
     *
     * @return string
     * @api
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    public function setLastResponse(ResponseInterface $response)
    {
        return $this->lastResponse = $response;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function cryptocurrency(): Cryptocurrency
    {
        return new Cryptocurrency($this);
    }

    public function tools(): Tools
    {
        return new Tools($this);
    }

    public function fiat(): Fiat
    {
        return new Fiat($this);
    }

    public function key(): Key
    {
        return new Key($this);
    }
}