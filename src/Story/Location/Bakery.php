<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Bakery
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Backbär";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in der Bäckerei "Backbär". Es duftet nach frischen Backwaren.
        Hinter der Theke steht die Verkäuferin. Jedoch bedient sie gerade einen anderen Kunden.
        TXT;
        GameEngine::setMap(portalE: true, person: true);

        return GameEngine::checkInput();
    }

}