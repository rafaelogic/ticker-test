
# Prerequisite
1. PHP 8.2
2. Docker (If using Laravel Sail)

# Setup
1. Run `composer install`
2. Run `cp .env.example .env`
3. Change the values of the ff:
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
4. Copy the values of the ff:
```
QUEUE_CONNECTION=database
```
5. Run `php artisan migrate`

# Testing
## Running the Ticker
```
php artisan schedule:run
php artisan queue:work database --queue=ticker

# OR when running the ticker every 15 minutes
php artisan queue:listen database --queue=ticker
```
Note: Go to `app/Console/Kernel.php` and uncommented the scheduled run to populate your database with data without waiting for 15 minutes to execute.

## Search
**via Ui**
Go to `localhost` 

**via API**
You can do a query like below:
```
http://localhost/api/v1/crypto/price?date_from=2023-09-01&date_to=2023-10-30
```