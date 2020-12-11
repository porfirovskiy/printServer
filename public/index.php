<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use PrintServer\RequestHandler;
use PrintServer\QueueHandler;
use PrintServer\Validator;

$validator = new Validator();

$request = new RequestHandler($validator);
if ($request->isSuccessfulProcessed()) {
    $queueHandler = new QueueHandler();
    $queueHandler->addTask($request->getTimeParam(), $request->getMessageParam());
    echo 'Task added!';
} else {
    echo 'Invalid GET params recived!';
}

