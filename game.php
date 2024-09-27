<?php

use App\GameLoop;

require "vendor/autoload.php";

$gameLoop = new GameLoop();

$gameLoop->start();