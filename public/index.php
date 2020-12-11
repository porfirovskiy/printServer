<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use PrintServer\RequestHandler;
use PrintServer\QueueHandler;

$request = new RequestHandler();
if ($request->isSuccessfulProcessed()) {
    $queueHandler = new QueueHandler();
    $queueHandler->addTask($request->getTimeParam(), $request->getMessageParam());
    echo 'Work well!';
} else {
    echo 'Invalid GET params recived!';
}

