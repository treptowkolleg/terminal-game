<?php

use App\GameEngine;

require "vendor/autoload.php";

$gameLoop = new GameEngine();
$gameLoop->start();