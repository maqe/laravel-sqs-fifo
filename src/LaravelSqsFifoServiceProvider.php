<?php

namespace Maqe\LaravelSqsFifo;

use Illuminate\Support\ServiceProvider;
use Maqe\LaravelSqsFifo\Connectors\SqsFifoConnector;

class LaravelSqsFifoServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving('queue', function ($manager) {
            $this->registerSqsFifoConnector($manager);
        });
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
