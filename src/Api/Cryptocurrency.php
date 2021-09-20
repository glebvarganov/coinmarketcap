<?php


namespace Devgleb\CoinMarketCap\Api;

class Cryptocurrency extends Api
{
    /**
     * Returns a mapping of all cryptocurrencies to unique CoinMarketCap id's
     *
     * @param string $listing_status    Listing status. Valid values: "active" / "inactive" / "untracked"
     * @param int $start                Optionally offset the start (1-based index) of the paginated list of items to return.
     * @param int $limit                Optionally specify the number of results to return.
     * @param string $sort              What field to sort the list of cryptocurrencies by. Valid values: "id" / "cmc_rank"
     * @param string $symbol            Optionally pass a comma-separated list of cryptocurrency symbols to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.
     * @param string $aux               Optionally specify a comma-separated list of supplemental data fields to return.
     * @return array
     * @throws \Exception
     */
    public function getList($listing_status = 'active', $start = 1, $limit = 100, $sort = 'id', $symbol = '', $aux = 'platform,first_historical_data,last_historical_data,is_active'): array
    {
        $params = [
            'listing_status' => $listing_status,
            'start' => $start,
            'limit' => $limit,
            'sort' => $sort,
            'aux' => $aux
        ];

        if (is_null($symbol) === false && empty($symbol) === false) {
            $params['symbol'] = $symbol;
        }

        return $this->get('/cryptocurrency/map', $params);
    }

    /**
     * Returns all static metadata available for one or more cryptocurrencies.
     * @link https://coinmarketcap.com/api/documentation/v1/#operation/getV1CryptocurrencyInfo
     *
     * @param string $id        One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"
     * @param string $slug      Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"
     * @param string $symbol    Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" or "slug" or "symbol" is required for this request.
     * @param string $address   Alternatively pass in a contract address. Example: "0xc40af1e4fecfa05ce6bab79dcd8b373d2e436c4e"
     * @param string $aux       Optionally specify a comma-separated list of supplemental data fields to return.
     *
     * @return array
     * @throws \Exception
     */
    public function getMetadata($id = '', $slug = '', $symbol = '', $address = '', $aux = 'urls,logo,description,tags,platform,date_added,notice'): array
    {
        $params = [
            'aux' => $aux
        ];

        if (empty($id) && empty($slug) && empty($symbol) && empty($address)) {
            throw new \InvalidArgumentException('At least one "id" or "slug" or "symbol" or "address" is required for this request.');
        }

        if (is_null($id) === false && empty($id) === false) {
            $params['id'] = $id;
        }

        if (is_null($slug) === false && empty($slug) === false) {
            $params['slug'] = $slug;
        }

        if (is_null($symbol) === false && empty($symbol) === false) {
            $params['symbol'] = $symbol;
        }

        if (is_null($address) === false && empty($address) === false) {
            $params['address'] = $address;
        }

        return $this->get('/cryptocurrency/info', $params);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getLatestListings(): array
    {
        $params = [];

        return $this->get('/cryptocurrency/listings/latest', $params);
    }


}