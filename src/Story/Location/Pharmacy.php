<?php

namespace App\Story\Location;

use App\Chars\Pharmacist;
use App\GameEngine;
use App\Story\Scene;

class Pharmacy
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Apotheke - Innen";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in der Apotheke. Die Apothekerin schaut dich erwartungsvoll an.
        Südlich von dir ist der Ausgang.
        TXT;
        GameEngine::setMap(portalS: true, person: true);
        Pharmacist::init();
        return GameEngine::checkInput();
    }

}