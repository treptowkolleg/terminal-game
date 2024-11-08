<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Bakery
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Backbär";
        return Scene::EXIT;
    }

}