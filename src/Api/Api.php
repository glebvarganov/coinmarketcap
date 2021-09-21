<?php


namespace Devgleb\CoinMarketCap\Api;


use Devgleb\CoinMarketCap\CoinMarketCap;
use Devgleb\CoinMarketCap\Message\ResponseTransformer;
use Exception;

class Api
{
    protected $CMC;

    private $version = 'v1';

    /** @var ResponseTransformer */
    protected $transformer;

    public function __construct(CoinMarketCap $CMC)
    {
        $this->CMC = $CMC;
        $this->transformer = new ResponseTransformer();
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws Exception
     */
    protected function get(string $uri, array $query = []): array
    {
        $response = $this->CMC->getHttpClient()->request(
            'GET',
            $this->version . $uri,
            [
                'query' => $query,
                'headers' => [
                    'X-CMC_PRO_API_KEY' => $this->CMC->getApiKey()
                ]
            ]
        );
        $this->CMC->setLastResponse($response);

        return $this->transformer->transform($response);
    }
}