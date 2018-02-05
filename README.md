# Google Finance Stocks for Laravel
This composer package will get from Google Finance all infos from a given stock (ex: BVMF:PETR4, NASDAQ:GOOGL, ...). Built to use with Laravel 5.x.

## Instalation
Begin by pulling in the package through Composer.
```
composer require murilobd/google-finance-stocks
```
If you're using Laravel >= 5.5, it's all done. If not, include the service provider and alias in your ```config/app.php```:
```php
'providers' => [
	Murilobd\GoogleFinanceStocks\GoogleFinanceStocksServiceProvider::class,
]
...
'aliases' => [
	'GoogleFinanceStocks' => Murilobd\GoogleFinanceStocks\GoogleFinanceStocksFacade::class
]
```

### Usage
Whenever you want a stock informations, just call:
```php
$exchange = 'BVMF';
$stock = 'PETR4';
$stock = GoogleFinanceStocks::requestStockInfos($exchange, $stock);
```

Mapped attributes are:
 - ***symbol***: Symbol
 - ***exchange***: Exchange
 - ***name***: Company name
 - ***low***: Lowest price in lastest trading day
 - ***high***: Highest price in lastest trading day
 - ***low52***: Lowest price in last 52 weeks
 - ***high52***: Highest price in last 52 weeks
 - ***open***: Open price in latest trading day
 - ***volume***: Number of shares traded in lastest trading day
 - ***avarage_volume***: Avarage of shares traded in last 30 days
 - ***market_cap***: Total value of a company in the stock market. It is generally calculated by multiplying the shares outstanding by the current share price.
 - ***price_to_earning***: Price to earning ratio
 - ***dividend***: Divident per share paid to shareholders in the most recent quarter
 - ***dividend_yeld***: Dividend yeld
 - ***earnings_per_share***: Earnings per share. The net income over the last four quarters divided by the shares outstanding.
 - ***shares***: Shares outstanding. The number of shares held by investors and company insiders, excluding dilutive securities such as non-vested RSUs and unexercised options.


#### Example:
```php
// Show stock symbol, company name and the lowest value from latest trading day
$stock = GoogleFinanceStocks::requestStockInfos('BVMF', 'PETR4');
echo $stock->symbol;
echo $stock->name;
echo $stock->low;
```


