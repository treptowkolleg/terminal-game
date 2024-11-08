<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Playground
{

    public static function basketball(): Scene
    {
        GameEngine::$sceneTitle = "Basketballplatz";
        return Scene::EXIT;
    }

}