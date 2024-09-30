<?php

use App\GameLoop;

require "vendor/autoload.php";

const PROJECT_DIR = __DIR__;
$gameLoop = new GameLoop();
echo "\e[5mblinking\e[0m";
// echo "\e[?25l";
$gameLoop->start();