<?php


namespace Devgleb\CoinMarketCap\Api;


class Fiat extends Api
{
    /**
     * Returns a mapping of all supported fiat currencies to unique CoinMarketCap ids.
     *
     * @param int $start Optionally offset the start (1-based index) of the paginated list of items to return.
     * @param int|null|string $limit [1 .. 5000] Optionally specify the number of results to return.
     * @param string $sort What field to sort the list by. Valid values: "id" / "name"
     * @param boolean $include_metals Pass true to include precious metals.
     * @return array
     * @throws \Exception
     */
    public function getList(int $start = 1, $limit = '', string $sort = 'id', $include_metals = true): array
    {
        $param = [
            'start' => $start,
            'sort' => $sort,
            'include_metals' => $include_metals ? 'true' : 'false',
        ];

        if ((is_null($limit) === false) && (empty($limit) === false)) {
            $params['limit'] = $limit;
        }

        return $this->get('/fiat/map', $param);
    }
}