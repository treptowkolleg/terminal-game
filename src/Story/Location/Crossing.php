<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Crossing
{

    public static function one(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Mosischstr.";
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Baumschulenstr.";
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Kreuzung Baumschulenstr./Mosischstr..";
        return GameEngine::checkInput();
    }

}