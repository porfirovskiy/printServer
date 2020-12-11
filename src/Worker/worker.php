<?php

declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use PrintServer\Worker\TaskHandler;

$redis = new \Predis\Client([
    'password' => 'p/O5d+5Xway6BW8+zAjh7fXicp7xT3cWnjkOdJTEM9l8zUoihLm7LHK9X7cwRQ1zfEKHmBvtqF4pky6E'
]);

$taskHandler = new TaskHandler($redis);
$taskHandler->runProccessing();