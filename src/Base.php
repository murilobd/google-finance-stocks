<?php

namespace Murilobd\GoogleFinanceStocks;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Base {

	const URL = 'https://finance.google.com/finance?q=';

	protected $client;

	function __construct()
	{
		$this->client = new Client();
	}

	/**
	 * Call Google Finance to retrieve stock infos
	 *
	 * @param: string $exchange Exchange's name (BVMF, NASDAQ, ...)
	 * @param: string $stock Stock's name (PETR4, GOOGL, ...)
	 * @return: stdClass (parsed JSON from request)
	 */
	protected function callGoogle($exchange, $stock)
	{
		$url = $this->createURL($exchange, $stock);

		try {
			$url = $this->createURL($exchange, $stock);
			$response = $this->client->request('GET', $url);
			$content = $response->getBody()->getContents();

			return $this->parseResults($content);
			
		} catch (RequestException $e) {
			throw new GoogleFinanceStocksException($e->getMessage(), 400);
		}
	}

	/**
	 * Parse google's JSON result to decode it and covert to a stdClass
	 *
	 * @param: string $result
	 * @return: stdClass
	 */
	private function parseResults($result)
	{
		$replace_eol = str_replace('\n', '', $result);
		$replace_comments = str_replace('// ', '', $replace_eol);
		
		return json_decode($replace_comments);
	}

	/**
	 * Crate URL to request Stock's infos
	 *
	 * @param: string $exchange
	 * @param: string $stock
	 * @return: string
	 */
	private function createURL($exchange, $stock)
	{
		return self::URL . $exchange . ':' . $stock . '&output=json';
	}
}