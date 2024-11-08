<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class SchoolGarden
{

    public static function north(): Scene
    {
        GameEngine::$sceneTitle = "Schulgarten - Beet";
        return Scene::EXIT;
    }

    public static function south(): Scene
    {
        GameEngine::$sceneTitle = "Schulgarten - Eingangsbereich";
        return Scene::EXIT;
    }

    public static function east(): Scene
    {
        GameEngine::$sceneTitle = "Schulgarten - Weg zum Schuppen";
        return Scene::EXIT;
    }

}