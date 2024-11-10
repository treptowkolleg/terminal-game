<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class SchoolGarden
{

    public static function north(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Schulgarten - Beet";
        return GameEngine::checkInput();
    }

    public static function south(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Schulgarten - Eingangsbereich";
        return GameEngine::checkInput();
    }

    public static function east(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Schulgarten - Weg zum Schuppen";
        return GameEngine::checkInput();
    }

}