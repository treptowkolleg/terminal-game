<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Pharmacy
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Apotheke - Innen";
        return Scene::EXIT;
    }

}