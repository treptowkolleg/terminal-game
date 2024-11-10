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
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Baumschulenstr.";
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Baumschulenstr./Mosischstr.";
        GameEngine::$sceneText = <<<TXT
        
        TXT;

        Go::to(Subject::EAST, Scene::TRAIN_STATION_ENTRANCE);
        Go::to(Subject::NORTH, Scene::STREET_MOSI);
        Go::to(Subject::WEST, Scene::STREET_BAUM);
        return GameEngine::checkInput();
    }

}