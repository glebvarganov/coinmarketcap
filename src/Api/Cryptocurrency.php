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
    public function getList($symbol = '', $start = 1, $limit = 100, $listing_status = 'active', $sort = 'id', $aux = 'platform,first_historical_data,last_historical_data,is_active'): array
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
    public function getInfo($id = '', $slug = '', $symbol = '', $address = '', $aux = 'urls,logo,description,tags,platform,date_added,notice'): array
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

    /**
     * Returns information about all coin categories available on CoinMarketCap
     * @link - https://coinmarketcap.com/api/documentation/v1/#operation/getV1CryptocurrencyCategories
     *
     * @param string $id Filtered categories by one or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2
     * @param string $slug Alternatively filter categories by a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"
     * @param string $symbol Alternatively filter categories one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH"
     * @param int $start Optionally offset the start (1-based index) of the paginated list of items to return
     * @param string $limit Optionally specify the number of results to return.
     * @return array
     * @throws \Exception
     */
    public function getCategories($id = '', $slug = '', $symbol = '', $start = 1, $limit = ''): array
    {
        $params = ['start' => $start];

        if (is_null($id) === false && empty($id) === false) {
            $params['id'] = $id;
        }

        if (is_null($slug) === false && empty($slug) === false) {
            $params['slug'] = $slug;
        }

        if (is_null($symbol) === false && empty($symbol) === false) {
            $params['symbol'] = $symbol;
        }

        if (is_null($limit) === false && empty($limit) === false) {
            $params['limit'] = $limit;
        }

        return $this->get('/cryptocurrency/categories', $params);
    }

    /**
     * Returns information about a single coin category available on CoinMarketCap.
     * @link https://coinmarketcap.com/api/documentation/v1/#operation/getV1CryptocurrencyCategory
     *
     * @param $id The Category ID. This can be found using the Categories API.
     * @param int $start Optionally offset the start (1-based index) of the paginated list of coins to return.
     * @param int $limit Optionally specify the number of coins to return.
     * @param string $convert Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols.
     * @param string $convert_id Optionally calculate market quotes by CoinMarketCap ID instead of symbol.
     * @return array
     * @throws \Exception
     */
    public function getCategory($id, $start = 1, $limit = 100, $convert = '', $convert_id = ''): array
    {
        $params = [
            'id' => $id,
            'start' => $start,
            'limit' => $limit
        ];

        return $this->get('/cryptocurrency/category', $params);
    }

    /**
     * Returns a list of past, present, or future airdrops which have run on CoinMarketCap.
     * @link https://coinmarketcap.com/api/documentation/v1/#operation/getV1CryptocurrencyAirdrops
     *
     * @param int $start Optionally offset the start (1-based index) of the paginated list of items to return.
     * @param int $limit Optionally specify the number of results to return.
     * @param string $status What status of airdrops. Valid values: "ONGOING" / "ENDED" / "UPCOMING"
     * @param string $id Filtered airdrops by one cryptocurrency CoinMarketCap IDs. Example: 1
     * @param string $slug Alternatively filter airdrops by a cryptocurrency slug. Example: "bitcoin"
     * @param string $symbol Alternatively filter airdrops one cryptocurrency symbol. Example: "BTC"
     * @return array
     * @throws \Exception
     */
    public function getAirdrops($start = 1, $limit = 100, $status = 'ONGOING', $id = '', $slug = '', $symbol = ''): array
    {
        $params = [
            'start' => $start,
            'limit' => $limit,
            'status' => strtoupper($status)
        ];

        if (is_null($id) === false && empty($id) === false) {
            $params['id'] = $id;
        }

        if (is_null($slug) === false && empty($slug) === false) {
            $params['slug'] = $slug;
        }

        if (is_null($symbol) === false && empty($symbol) === false) {
            $params['symbol'] = $symbol;
        }

        return $this->get('/cryptocurrency/airdrops', $params);
    }

    /**
     * Returns information about a single airdrop available on CoinMarketCap.
     * @link https://coinmarketcap.com/api/documentation/v1/#operation/getV1CryptocurrencyAirdrop
     *
     * @param int $id Airdrop Unique ID. This can be found using the Airdrops API.
     * @return array
     * @throws \Exception
     */
    public function getAirdrop($id): array
    {
        $params = ['id' => $id];
        return $this->get('/cryptocurrency/airdrop', $params);
    }

}