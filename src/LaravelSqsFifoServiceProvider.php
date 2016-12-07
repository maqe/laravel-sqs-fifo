<?php

namespace Maqe\LaravelSqsFifo;

use Illuminate\Support\ServiceProvider;
use Maqe\LaravelSqsFifo\Connectors\SqsFifoConnector;

class LaravelSqsFifoServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $queueManager = $this->app['queue'];

        $this->registerSqsFifoConnector($queueManager);
    }

    /**
     * Register the Amazon SQS FIFO queue connector.
     *
     * @param  \Illuminate\Queue\QueueManager  $manager
     * @return void
     */
    protected function registerSqsFifoConnector($manager)
    {
        $manager->addConnector('sqsfifo', function () {
            return new SqsFifoConnector;
        });
    }
}
