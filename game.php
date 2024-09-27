<?php

use App\GameLoop;

require "vendor/autoload.php";

const PROJECT_DIR = __DIR__;
$gameLoop = new GameLoop();
$gameLoop->start();