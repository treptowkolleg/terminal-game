<?php

namespace App\Story\Location;

use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Scene;
use App\System\Go;

class Street
{

    public static function one(): Scene
    {
        GameEngine::$sceneTitle = "Kiefholzstraße";
        Go::to(Subject::NORTH,Scene::CROSSING_KIEF_MOSI);
        Go::to(Subject::SOUTH, Scene::CROSSING_KIEF_BAUM);
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Baumschulenstraße";
        Go::to(Subject::WEST,Scene::CROSSING_KIEF_BAUM);
        Go::to(Subject::EAST, Scene::CROSSING_BAUM_MOSI);
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Mosischstraße";
        GameEngine::$sceneText = <<<TXT
        Dies ist die Mosischstraße.
        TXT;
        Go::to(Subject::WEST,Scene::CROSSING_KIEF_MOSI);
        Go::to(Subject::SOUTH, Scene::CROSSING_BAUM_MOSI);
        return GameEngine::checkInput();
    }

}