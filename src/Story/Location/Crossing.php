<?php

namespace App\Story\Location;

use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Scene;
use App\System\Go;
use App\System\LocationMap;

class Crossing
{

    public static function one(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Mosischstr.";
        Go::to(Subject::SOUTH,Scene::STREET_KIEF);
        Go::to(Subject::EAST, Scene::STREET_MOSI);
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        GameEngine::$map = LocationMap::render(east: true, south: true);
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Kiefholzstr./Baumschulenstr.";
        Go::to(Subject::NORTH,Scene::STREET_KIEF);
        Go::to(Subject::EAST, Scene::STREET_BAUM);
        GameEngine::$sceneText = <<<TXT
        
        TXT;
        GameEngine::setMap(north: true, east: true);
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::$sceneTitle = "Kreuzung Baumschulenstr./Mosischstr.";
        GameEngine::$sceneText = <<<TXT
        Diese Kreuzung führt nördlich in die Mosichstraße und westlich in die Baumschulenstraße.
        Östlich liegt der Bahnhof.
        TXT;
        GameEngine::setMap(north: true, east: true, west: true);

        Go::to(Subject::EAST, Scene::TRAIN_STATION_ENTRANCE);
        Go::to(Subject::NORTH, Scene::STREET_MOSI);
        Go::to(Subject::WEST, Scene::STREET_BAUM);
        return GameEngine::checkInput();
    }

}