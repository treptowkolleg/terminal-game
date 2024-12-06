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
        GameEngine::$map = <<<MAP
            |===>
            |
            ^
        MAP;
        Go::to(Subject::SOUTH,Scene::STREET_KIEF);
        Go::to(Subject::EAST, Scene::STREET_MOSI);
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Baumschulenstr.";
        GameEngine::$map = <<<MAP
            
            
            |===>
        MAP;
        Go::to(Subject::NORTH,Scene::STREET_KIEF);
        Go::to(Subject::EAST, Scene::STREET_BAUM);
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Baumschulenstr./Mosischstr.";
        GameEngine::$map = <<<MAP
                ^
                |
            <===|===>
        MAP;
        GameEngine::$sceneText = <<<TXT
        Diese Kreuzung führt nördlich in die Mosichstraße und westlich in die Baumschulenstraße.
        Östlich liegt der Bahnhof.
        TXT;

        Go::to(Subject::EAST, Scene::TRAIN_STATION_ENTRANCE);
        Go::to(Subject::NORTH, Scene::STREET_MOSI);
        Go::to(Subject::WEST, Scene::STREET_BAUM);
        return GameEngine::checkInput();
    }

}