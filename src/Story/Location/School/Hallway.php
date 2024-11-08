<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Hallway
{

    public static function one(): Scene
    {
        GameEngine::$sceneTitle = "Flur";
        return Scene::EXIT;
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Flur";
        return Scene::EXIT;
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Flur";
        return Scene::EXIT;
    }

}