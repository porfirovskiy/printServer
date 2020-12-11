<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use PrintServer\RequestHandler;
use PrintServer\QueueHandler;
use PrintServer\Validator;

$validator = new Validator();

$request = new RequestHandler($validator);
if ($request->isSuccessfulProcessed()) {
    $redis = new \Predis\Client([
        'password' => 'p/O5d+5Xway6BW8+zAjh7fXicp7xT3cWnjkOdJTEM9l8zUoihLm7LHK9X7cwRQ1zfEKHmBvtqF4pky6E'
    ]);
    $queueHandler = new QueueHandler($redis);
    $queueHandler->addTask($request->getTimeParam(), $request->getMessageParam());
    echo 'Task added!';
} else {
    echo 'Invalid GET params recived!';
}

