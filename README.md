<img width="743" alt="image" src="https://github.com/rafaelogic/ticker-test/assets/5935096/4695033e-8d24-4219-bd4d-013298a3af85">

# Prerequisite
1. PHP 8.2
2. Docker (If using Laravel Sail)

# Setup
1. Run `cp .env.example .env`
2. Run `php artisan key:generate`
3. Run `composer install`
4. Change the values of the ff:
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
5. Copy the values of the ff:
```
QUEUE_CONNECTION=database
```
6. Run `php artisan migrate`

# Testing
## Running the Ticker
```
php artisan schedule:run
php artisan queue:work database --queue=ticker

# OR when running the ticker every 15 minutes
php artisan queue:listen database --queue=ticker
```
Note: Go to `app/Console/Kernel.php` and uncomment the scheduled task without execution time to instantly populate your database, rather than waiting the default 15 minutes for execution.

## Search
**via UI**
Go to `localhost` 

**via API**
You can do a query like below:
```
http://localhost/api/v1/crypto/price?date_from=2023-09-01&date_to=2023-10-30
```
