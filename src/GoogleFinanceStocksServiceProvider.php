<?php

namespace Murilobd\GoogleFinanceStocks;

use Illuminate\Support\ServiceProvider;
use Murilobd\GoogleFinanceStocks\GoogleFinanceStocks;

class GoogleFinanceStocksServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('google_finance_stocks', function ($app) {
			return new GoogleFinanceStocks();
		});
	}
}
