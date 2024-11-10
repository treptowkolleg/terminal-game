<?php

namespace App\Story\Location;

use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Scene;
use App\System\Go;

class Crossing
{

    public static function one(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Mosischstr.";
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Baumschulenstr.";
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Baumschulenstr./Mosischstr.";

        Go::to(Subject::EAST, Scene::TRAIN_STATION_ENTRANCE);
        Go::to(Subject::NORTH, Scene::STREET_MOSI);
        Go::to(Subject::WEST, Scene::STREET_BAUM);
        return GameEngine::checkInput();
    }

}