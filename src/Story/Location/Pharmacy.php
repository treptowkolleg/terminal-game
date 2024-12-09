<?php

namespace App\Story\Location;

use App\Chars\Pharmacist;
use App\GameEngine;
use App\Story\Scene;
use App\System\Leave;

class Pharmacy
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Apotheke - Innen";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in der Apotheke. Die Apothekerin schaut dich erwartungsvoll an.
        Südlich von dir ist der Ausgang.
        TXT;
        Leave::from("apotheke",Scene::STREET_BAUM);
        GameEngine::setMap(portalS: true, person: true);
        Pharmacist::init();
        return GameEngine::checkInput();
    }

}