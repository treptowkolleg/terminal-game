<?php

namespace App\Story\Chapter01;


use App\GameEngine;
use App\Objects\PrologDoor;
use App\Objects\PrologSign;
use App\Story\Scene;


class Prolog
{

    public static function prolog(): Scene
    {
        GameEngine::$sceneTitle = "Startmenü";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in einem leeren Raum. Nördlich von dir befindet sich eine Tür. Daneben hängt ein Schild an
        der Wand.
        TXT;

        GameEngine::addHotKey(PrologSign::get());
        GameEngine::addHotKey(PrologDoor::get());

        return GameEngine::checkInput();
    }

}