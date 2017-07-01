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

## Configure

You can then create an SQS FIFO queue connection by adding it to your `config/queue.php` file:

```php
'connections' => [

    ...

    'my_sqs_fifo' => [
        'driver' => 'sqsfifo',
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'queue'  => env('AWS_SQS_URL'),
        'region' => env('AWS_SQS_REGION'),
    ],
],
```

Then you may use this FIFO queue as the default by setting in `config/queue.php`:

```php
    'default' => 'my_sqs_fifo',
```

Or call/listen to the FIFO queue specifically:

```php
Queue::connection('my_sqs_fifo')->pushOn('my_queue_name', new MyQueueJob); // Laravel 5.1

(new MyQueueJob)->onConnection('my_sqs_fifo'); // Laravel 5.2+
```

```bash
php artisan queue:listen connection
php artisan queue:work connection
```
