<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Shop
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Späti - Innen";
        return Scene::EXIT;
    }

}