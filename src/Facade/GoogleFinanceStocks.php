<?php

namespace Murilobd\GoogleFinanceStocks\Facade;

use Illuminate\Support\Facades\Facade;

class GoogleFinanceStocks extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'google_finance_stocks';
	}
}