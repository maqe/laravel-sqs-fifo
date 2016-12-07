# Laravel SQS FIFO Queue

Adds support for SQS FIFO Queue to Laravel.

## Setup

Add package dependency to your project's `composer.json` file:

```json
"require": {
    "maqe/laravel-sqs-fifo": "dev-master"
}
```

Run composer update:

```bash
composer update
```

Add package's service provider to your project's `config/app.php`:

```php
'providers' => array(
    Maqe\LaravelSqsFifo\LaravelSqsFifoServiceProvider::class,
),
```
