<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Street
{

    public static function one(): Scene
    {
        GameEngine::$sceneTitle = "Kiefholzstraße";
        return Scene::EXIT;
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Baumschulenstraße";
        return Scene::EXIT;
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Mosischstraße";
        return Scene::EXIT;
    }

}