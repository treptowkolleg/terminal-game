<?php

namespace App\Story\Location;

use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Scene;
use App\System\Enter;
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
        GameEngine::$sceneText = <<<TXT
        In der Baumschulenstraße befinden sich zahlreiche Geschäfte. Die meisten davon haben allerdings noch
        geschlossen. Lediglich die Apotheke ist bereits geöffnet.
        TXT;

        Enter::to("apotheke",Scene::PHARMACY);
        Go::to(Subject::WEST,Scene::CROSSING_KIEF_BAUM);
        Go::to(Subject::EAST, Scene::CROSSING_BAUM_MOSI);
        GameEngine::setMap(east: true, west: true, portalN: true);
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