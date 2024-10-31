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
use App\System\HotKeySet;
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

        $sign = SceneObject::make("Schild","Türschild",function (VerbDict $verb){
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

            if($verb == VerbDict::READ)
                Out::printLn($txt);
            if ($verb == VerbDict::LOOK)
                Out::printLn("Das Schild scheint eine Anleitung zu beinhalten.");
            if($verb == VerbDict::TAKE)
                Out::printLn("Das Schild ist festgeschraubt. Du kannst es nicht mitnehmen.");
        });

        // lies Schild
        $signSet = new HotKeySet($sign);
        $signSet
            ->addKey(VerbDict::READ)
            ->addKey(VerbDict::LOOK)
            ->addKey(VerbDict::TAKE)
        ;

        GameEngine::addHotKey($signSet);

        return GameEngine::checkInput();
    }

}