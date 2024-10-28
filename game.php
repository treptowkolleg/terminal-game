<?php

use App\GameEngine;

require "vendor/autoload.php";

const PROJECT_DIR = __DIR__;
$gameLoop = new GameEngine();
$gameLoop->start();