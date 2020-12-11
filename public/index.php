<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use PrintServer\RequestHandler;

$request = new RequestHandler();
$request->processing();

