<?php

namespace PrintServer\Worker;

use Predis\Collection\Iterator;

/**
 * Description of Server
 *
 * @author porfirovskiy
 */
class TaskHandler {
    
    protected $redis;
    
    public function __construct() {
        $this->redis = new \Predis\Client([
            'password' => 'p/O5d+5Xway6BW8+zAjh7fXicp7xT3cWnjkOdJTEM9l8zUoihLm7LHK9X7cwRQ1zfEKHmBvtqF4pky6E'
        ]);
    }
    
    public function runProccessing(): void
    {
        while (true) {
            foreach (new Iterator\Keyspace($this->redis, "*") as $key) {
                $this->outputIntoConsole($key);
            }
        }
    }
    
    protected function isTheTimeRight(string $recordTime): bool
    {
        if($recordTime <= date('Y-m-d H:i:s')) { 
                return true;
        }
        
        return false;
    }
    
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
