<?php

namespace Maqe\LaravelSqsFifo;

use Illuminate\Queue\SqsQueue;

class SqsFifoQueue extends SqsQueue
{
    /**
     * Push a raw payload onto the queue.
     *
     * @param  string  $payload
     * @param  string  $queue
     * @param  array   $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        $message = [
            'QueueUrl' => $this->getQueue($queue),
            'MessageBody' => $payload,
        ];

        if($this->isFifoQueue($queue)) {
            $message['MessageGroupId'] = uniqid();
            $message['MessageDeduplicationId'] = uniqid();
        }

        $response = $this->sqs->sendMessage($message);

        return $response->get('MessageId');
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  \DateTime|int  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        $payload = $this->createPayload($job, $data);

        $delay = $this->getSeconds($delay);

        $message = [
            'QueueUrl' => $this->getQueue($queue),
            'MessageBody' => $payload,
            'DelaySeconds' => $delay,
        ];

        if($this->isFifoQueue($queue)) {
            $message['MessageGroupId'] = uniqid();
            $message['MessageDeduplicationId'] = uniqid();
        }

        return $this->sqs->sendMessage($message)->get('MessageId');
    }

    protected function isFifoQueue($queue) : bool
    {
        return (strpos($this->getQueue($queue), '.fifo') !== FALSE);
    }
}
