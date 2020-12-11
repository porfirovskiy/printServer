<?php

namespace PrintServer;

/**
 * Class for creating tasks in Redis storage
 *
 * @author porfirovskiy
 */
class QueueHandler {
    
    protected $redis;
    
    /**
     * 
     * @param \Predis\Client $redis
     */
    public function __construct(\Predis\Client $redis) 
    {
        $this->redis = $redis;
    }
    
    /**
     * Add task to Redis queue
     * 
     * @param string $time
     * @param string $message
     * @return void
     */
    public function addTask(string $time, string $message): void
    {
        $this->redis->set($time, $message);
    }
    
}
