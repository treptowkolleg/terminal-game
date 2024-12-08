<?php

namespace App\System;

use App\Story\Scene;

class DebugKeySet
{
    /**
     * "Cheat Codes" zum schnellen Springen zu bestimmten Szenen.
     * Dies dient dem Testen von Szenen, ohne jedes Mal das Spiel richtig spielen zu müssen.
     * @return void
     */
    public static function get(): void
    {
        Go::debug("sc001", Scene::TRAIN_STATION_PLATFORM);
        Go::debug("sc002", Scene::TRAIN_STATION_ENTRANCE);
        Go::debug("sc005", Scene::BAKERY);
        Go::debug("sc003", Scene::PHARMACY);
    }
}