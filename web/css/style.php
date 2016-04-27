<?php

require(__DIR__ . '/../../vendor/autoload.php');

use Leafo\ScssPhp\Server;

$directory = __DIR__ . '/../../assets/scss/';

Server::serveFrom($directory);
