<?php

namespace App\Story\Location;

use App\Dictionary\Subject;
use App\GameEngine;
use App\Story\Objects\TrainStation\Stairs;
use App\Story\Scene;
use App\System\Go;

class TrainStation
{

    public static function entrance(): Scene
    {
        GameEngine::$sceneTitle = "S-Bhf Baumschulenweg - Eingang";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in der Eingangshalle des Bahnhofs. Ein junger Mann sitzt zusammengekauert auf einer Bank.
        Ihm ist sichtlich übel. Eine Treppe führt nach oben zum Bahnsteig. Westlich von dir befindet sich der Ausgang
        zur Straße.
        TXT;

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

        Stairs::down();

        return GameEngine::checkInput();
    }

}