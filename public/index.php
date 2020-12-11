<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use PrintServer\RequestHandler;
use PrintServer\QueueHandler;

$request = new RequestHandler();
if ($request->isSuccessfulProcessed()) {
    $queueHandler = new QueueHandler();
    $queueHandler->addTask('12:00', 'it`s work fine!');
    echo 'Work well!';
} else {
    echo 'Invalid GET params recived!';
}

