<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class TrainStation
{

    public static function entrance(): Scene
    {
        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Eingang";
        return Scene::EXIT;
    }

    public static function platform(): Scene
    {
        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Bahnsteig";
        return Scene::EXIT;
    }

}