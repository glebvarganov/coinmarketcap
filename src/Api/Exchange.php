<?php


namespace Devgleb\CoinMarketCap\Api;


class Exchange extends Api
{
    /**
     * Returns all static metadata for one or more exchanges.
     * @link https://coinmarketcap.com/api/documentation/v1/#operation/getV1ExchangeInfo
     *
     * @param string $id One or more comma-separated CoinMarketCap cryptocurrency exchange ids. Example: "1,2"
     * @param string $slug Alternatively, one or more comma-separated exchange names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens). Example: "binance,gdax".
     * @param string $aux Optionally specify a comma-separated list of supplemental data fields to return.
     * @return array
     * @throws \Exception
     */
    public function getInfo($id = '', $slug = '', $aux = 'urls,logo,description,date_launched,notice')
    {
        if (empty($id) && empty($slug)) {
            throw new \InvalidArgumentException('At least one "id" or "slug" is required.');
        }

        $params = [
            'aux' => $aux
        ];

        if (!empty($id)) {
            $params['id'] = $id;
        }

        if (!empty($slug)) {
            $params['slug'] = $slug;
        }

        return $this->get('/exchange/info', $params);
    }
}