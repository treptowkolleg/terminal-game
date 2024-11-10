<?php

namespace App\Story;


use App\GameEngine;
use App\Story\Objects\Prolog\PrologDoor;
use App\Story\Objects\Prolog\PrologSign;

class Prolog
{
    public static function prolog(): Scene
    {
        GameEngine::$sceneTitle = "Startmenü";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in einem leeren Raum. Lediglich eine Tür und ein daneben hängendes Schild sind zu sehen.
        TXT;

        GameEngine::resetHotKeys();
        PrologSign::init();
        PrologDoor::init();

        return GameEngine::checkInput();
    }

    public static function end(): Scene
    {
        GameEngine::resetHotKeys();
        return GameEngine::checkInput();
    }

}