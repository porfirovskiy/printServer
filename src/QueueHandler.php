<?php

namespace PrintServer;

/**
 * Description of QueueHandler
 *
 * @author porfirovskiy
 */
class QueueHandler {
    
    protected $redis;
    
    public function __construct() {
        $this->redis = new \Predis\Client([
            'password' => 'p/O5d+5Xway6BW8+zAjh7fXicp7xT3cWnjkOdJTEM9l8zUoihLm7LHK9X7cwRQ1zfEKHmBvtqF4pky6E'
        ]);
    }
    
    public function addTask(string $time, string $message): void
    {
        $this->redis->set($time, $message);
    }
    
    protected function checkDuplicateParams(string $time, string $message): bool
    {
        
    }
    
}
