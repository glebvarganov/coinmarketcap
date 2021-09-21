<?php


namespace Devgleb\CoinMarketCap\Api;


class Tools extends Api
{
    /**
     * Convert an amount of one cryptocurrency or fiat currency into one or more different currencies utilizing the latest market rate for each currency.
     *
     * @param numeric $amount           (mandatory) An amount of currency to convert. Example: 10.43
     * @param string $id                The CoinMarketCap currency ID of the base cryptocurrency or fiat to convert from. Example: "1"
     * @param string $symbol            Alternatively the currency symbol of the base cryptocurrency or fiat to convert from. Example: "BTC".
     * @param string $time              Optional timestamp (Unix or ISO 8601) to reference historical pricing during conversion.
     * @param array|string $convert     Pass up to 120 comma-separated fiat or cryptocurrency symbols to convert the source amount to.
     * @param string $convert_id
     * @return array
     * @throws \Exception
     */
    public function getConvertPrice($amount, $id = '', $symbol = '', $convert = '', $convert_id = '', $time = ''): array
    {
        if (empty($id) && empty($symbol)) {
            throw new \InvalidArgumentException('One "id" or "symbol" is required.');
        }

        $params = [
            'amount' => $amount,
        ];

        if (is_null($time) === false && empty($time) === false) {
            $params['time'] = $time;
        }

        if (is_null($id) === false && empty($id) === false) {
            $params['id'] = $id;
        }

        if (is_null($symbol) === false && empty($symbol) === false) {
            $params['symbol'] = $symbol;
        }

        if (is_null($convert) === false && empty($convert) === false) {
            $params['convert'] = is_array($convert) ? implode(',', $convert) : $convert;
        }

        if (is_null($convert_id) === false && empty($convert_id) === false) {
            $params['convert_id'] = $convert_id;
        }

        return $this->get('/tools/price-conversion', $params);
    }
}