<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class TrainStation
{

    public static function entrance(): Scene
    {

        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Eingang";
        return Scene::EXIT;
    }

    public static function platform(): Scene
    {

        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Bahnsteig";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich auf dem Bahnsteig. Wegen einer Störung fahren gerade keine Züge.
        Eine Treppe führt nach unten zum Eingang des Bahnhofs.
        TXT;

        GameEngine::resetHotKeys();

        return GameEngine::checkInput();
    }

}