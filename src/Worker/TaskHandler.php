<?php

namespace PrintServer\Worker;

use Predis\Collection\Iterator;

/**
 * Class for tasks handler
 *
 * @author porfirovskiy
 */
class TaskHandler {
    
    protected $redis;
    
    /**
     * 
     * @param \Predis\Client $redis
     */
    public function __construct(\Predis\Client $redis) {
        $this->redis = $redis;
    }
    
    /**
     * Run tasks processing from queue
     * 
     * @return void
     */
    public function runProccessing(): void
    {
        while (true) {
            foreach (new Iterator\Keyspace($this->redis, "*") as $key) {
                $this->outputIntoConsole($key);
            }
        }
    }
    
    /**
     * Check if time params is right
     * 
     * @param string $recordTime
     * @return bool
     */
    protected function isTheTimeRight(string $recordTime): bool
    {
        if($recordTime <= date('Y-m-d H:i:s')) { 
                return true;
        }
        
        return false;
    }
    
    /**
     * Print time message into console
     * 
     * @param string $key
     * @return void
     */
    protected function outputIntoConsole(string $key): void
    {
        if($this->isTheTimeRight($key)) { 
            $message = $this->redis->get($key);
            echo $key . " - " . $message . "\n";
            $this->redis->del($key);
            sleep(1);
        }
    }
    
}
