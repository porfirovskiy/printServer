<?php

namespace PrintServer\Worker;

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
    
    public function proccessing(): void
    {
        while (true) {
            //try {
                
                $data = $this->redis->get('yu23');
                
                sleep(1);
                
                echo $data;
                //$ret = $redisQueue->remove($data);

            /*} catch (RedisQueueException $e) {
                echo $e->getMessage();

            }*/
        }
    }
    
}
