<?php

namespace App\Listeners;

trait QueueTrait
{
     /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';
 
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'ticker';
}