<?php

namespace App\Story;


use App\GameEngine;
use App\Story\Objects\PrologDoor;
use App\Story\Objects\PrologSign;

class Prolog
{
    public static function prolog(): Scene
    {
        GameEngine::$sceneTitle = "Startmenü";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in einem leeren Raum. Nördlich von dir befindet sich eine Tür. Daneben hängt ein Schild an
        der Wand.
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