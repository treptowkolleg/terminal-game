<?php

namespace App\Story\Chapter01;


use App\Chars\MrSchubert;
use App\Chars\MsMuller;
use App\Dictionary\PrepDict;
use App\Dictionary\SubjectDict;
use App\Dictionary\VerbDict;
use App\GameEngine;
use App\Story\Scene;
use App\System\HotKey;
use App\System\In;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class Prolog
{

    public static function end(): Scene
    {
        Out::printLn("Das Spiel ist hier zu ende.");

        $input = readline("p für Szene Prolog: ");
        $input = strtolower($input);

        Out::clearView();

        if($input == "exit")    return Scene::EXIT;
        if($input == "p")       return Scene::PROLOG;

        return Scene::EPILOG;
    }

    public static function prolog(): Scene
    {
        GameEngine::$sceneTitle = "Startmenü";
        GameEngine::$sceneText = <<<TXT
        Du befindest dich in einem leeren Raum. Nördlich von dir befindet sich eine Tür. Daneben hängt ein Schild an
        der Wand.
        TXT;

        $sign = SceneObject::make("Schild","Türschild",function (){
            $txt = <<<TXT
            Dies ist der Startraum. Ziel dieses Spiels ist, mit der Schulleitung Kuchen essen zu gehen. Dafür
            musst Du jedoch einige Hürden meistern. Du kannst dich nach folgendem Muster durch das Spiel navigieren:
            
            Verb [Objekt A] [Präposition] [Objekt B]
            
            Beispiele:
            
            umsehen
            untersuche Schild
            gehe nach Norden
            benutze Schlüssel mit Tür
            
            Gib "ende" ein, um das Spiel zu beenden. Beachte, dass du nicht speichern kannst. Jedoch ist das Spiel
            auch nicht so lang. Viel Glück!
            TXT;

            Out::printLn($txt);
        });

        // lies Schild
        $SignHotKey = new HotKey(VerbDict::READ, b: $sign);
        $goNorth = new HotKey(VerbDict::GO, preposition: PrepDict::TO, b: SubjectDict::NORTH);
        GameEngine::addHotKey($SignHotKey);
        GameEngine::addHotKey($goNorth);

        return GameEngine::checkInput();
    }

}