<?php

namespace Murilobd\GoogleFinanceStocks;

use Murilobd\GoogleFinanceStocks\Base;
use Murilobd\GoogleFinanceStocks\GoogleFinanceStocksException;

class GoogleFinanceStocks extends Base {

	/**
	 * Mapped google's results keys to human readable keys
	 */
	private $mapInfos = [
		/**
		 * Symbol
		 */
		'stock' => 'symbol',
		/**
		 * Exchange
		 */
		'exchange' => 'exchange',
		/**
		 * Company name
		 */
		'name' => 'name',
		/**
		 * Last price in latest trading day
		 */
		'price' => 'l',
		/**
		 * Last variation in percentage in latest trading day
		 */
		'variation' => 'cp',
		/**
		 * Lowest price in lastest trading day
		 */
		'low' => 'lo',
		/**
		 * Highest price in lastest trading day
		 */
		'high' => 'hi',
		/**
		 * Lowest price in last 52 weeks
		 */
		'low52' => 'lo52',
		/**
		 * Highest price in last 52 weeks
		 */
		'high52' => 'hi52',
		/**
		 * Open price in latest trading day
		 */
		'open' => 'op',
		/**
		 * Number of shares traded in lastest trading day
		 */
		'volume' => 'vo',
		/**
		 * Avarage of shares traded in last 30 days
		 */
		'avarage_volume' => 'avvo',
		/**
		 * Total value of a company in the stock market. It is generally calculated by multiplying the shares outstanding by the current share price.
		 */
		'market_cap' => 'mc',
		/**
		 * Price to earning ratio
		 */
		'pe' => 'pe',
		/**
		 * Divident per share paid to shareholders in the most recent quarter
		 */
		'dividend' => 'ldiv',
		/**
		 * Dividend yeld.
		 */
		'dividend_yeld' => 'dy',
		/**
		 * Earnings per share. The net income over the last four quarters divided by the shares outstanding.
		 */
		'eps' => 'eps',
		/**
		 * Shares outstanding. The number of shares held by investors and company insiders, excluding dilutive securities such as non-vested RSUs and unexercised options.
		 */
		'shares' => 'shares',
	];

	private $infosFromGoogle;

	public function __get($key)
	{
		return $this->getValueFromInfos($this->getMappedKey($key));
	}

	/**
	 * Get google's key from human readable key
	 *
	 * @param: string $key
	 * @return: mixed (string|null)
	 */
	private function getMappedKey($key)
	{
		return isset($this->mapInfos[$key]) ? $this->mapInfos[$key] : null;
	}

	/**
	 * Get stock info
	 *
	 * @param: string $key
	 * @return: mixed (string|null)
	 */
	private function getValueFromInfos($key)
	{
		if (is_null($key))
			return null;

		return isset($this->infosFromGoogle->$key) ? $this->infosFromGoogle->$key : null;
	}

	/**
	 * Request to Google stock infos
	 *
	 * @param: string $exchange Exchange's name (BVMF, NASDAQ, ...)
	 * @param: string $stock Stock's name (PETR4, GOOGL, ...)
	 * @return: self
	 */
	public function requestStockInfos($exchange = null, $stock = null)
	{
		try {
			$infos = $this->callGoogle($exchange, $stock);

			$this->setStockInfos($infos);
			
			return $this;
		} catch (GoogleFinanceStocksException $e) {
			throw new GoogleFinanceStocksException($e->getMessage(), 400);
		}
	}

	/**
	 * Set stock infos
	 *
	 * @param: array $infos
	 * @return: null
	 */
	private function setStockInfos($infos)
	{
		if (is_array($infos)) {
			$infos = $infos[0];
		} else {
			$infos = null;
			return;
		}

		$this->infosFromGoogle = $infos;
	}
}