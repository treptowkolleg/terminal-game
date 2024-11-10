<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class SchoolOffice
{

    public static function interior(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Büro - Schulleitung";
        return GameEngine::checkInput();
    }

}