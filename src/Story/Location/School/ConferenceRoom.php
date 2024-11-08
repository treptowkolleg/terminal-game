<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class ConferenceRoom
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Konferenzraum";
        return Scene::EXIT;
    }

}