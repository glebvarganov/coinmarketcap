<?php


namespace Devgleb\CoinMarketCap\Api;


class Key extends Api
{
    /**
     * Returns API key details and usage stats.
     * @link https://coinmarketcap.com/api/documentation/v1/#tag/key
     *
     * @return array
     * @throws \Exception
     */
    public function getInfo(): array
    {
        return $this->get('/key/info');
    }
}