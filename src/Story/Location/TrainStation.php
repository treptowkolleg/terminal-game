<?php

namespace App\Story\Location;

use App\Chars\Peter;
use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Objects\TrainStation\Stairs;
use App\Story\Scene;
use App\System\Go;
use App\System\LocationMap;

class TrainStation
{

    # |↗ = nach oben
    # ↙| = nach unten
    # der Rest wie Pfeilrichtung, also Ost, West, Nord, Süd

    public static function entrance(): Scene
    {
        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Eingang";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in der Eingangshalle des Bahnhofs. Ein junger Mann sitzt auf einer Bank. Eine Treppe führt
        nach oben zum Bahnsteig. Westlich von dir befindet sich der Ausgang zur Straße.
        TXT;
        GameEngine::setMap(west: true, up: true, person: true);

        Peter::init();
        Stairs::up();
        Go::to(Subject::WEST, Scene::CROSSING_BAUM_MOSI);

        return GameEngine::checkInput();
    }

    public static function platform(): Scene
    {
        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Bahnsteig";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich auf dem Bahnsteig. Wegen einer Störung fahren gerade keine Züge.
        Eine Treppe führt nach unten zum Eingang des Bahnhofs.
        TXT;
        GameEngine::setMap(down: true);

        Stairs::down();

        return GameEngine::checkInput();
    }

}