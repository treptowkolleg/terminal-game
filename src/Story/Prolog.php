<?php

namespace App\Story;


use App\GameEngine;
use App\Story\Objects\PrologDoor;
use App\Story\Objects\PrologSign;
use App\System\Out;

class Prolog
{
    public static function prolog(): Scene
    {
        GameEngine::$sceneTitle = "Startmenü";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in einem leeren Raum. Lediglich eine Tür und ein daneben hängendes Schild sind zu sehen.
        TXT;

        GameEngine::resetHotKeys();
        GameEngine::addHotKey(PrologSign::get());
        GameEngine::addHotKey(PrologDoor::get());

        return GameEngine::checkInput();
    }

    public static function end(): Scene
    {
        return GameEngine::checkInput();
    }

}