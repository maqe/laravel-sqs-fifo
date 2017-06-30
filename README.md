# Laravel SQS FIFO Queue

Adds support for SQS FIFO Queue to Laravel.

## Setup

Add package dependency to your project:

```console
composer require maqe/laravel-sqs-fifo
```

Before Laravel 5.5, add package's service provider to your project's `config/app.php`:

```php
'providers' => [
    Maqe\LaravelSqsFifo\LaravelSqsFifoServiceProvider::class,
],
```

This package is [auto discoverable](https://laravel-news.com/package-auto-discovery) by Laravel 5.5.
