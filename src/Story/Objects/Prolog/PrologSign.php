<?php

namespace App\Story\Objects\Prolog;

use App\Dictionary\Verb;
use App\GameEngine;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class PrologSign
{

    public static function init(): void
    {
        $sign = SceneObject::make("Schild","Türschild",function (Verb $verb){
            $txt = <<<TXT
            WILLKOMMEN:
            Dies ist der Startraum. Ziel dieses Spiels ist, mit der Schulleitung Kuchen essen zu gehen. Dafür
            musst Du jedoch einige Hürden meistern. Du kannst dich nach folgendem Muster durch das Spiel navigieren:
            
            SYNTAX:            
            Verb [Objekt A] [Präposition] [Objekt B]
            
            BEISPIELE:
            umsehen
            betrachte Schild
            gehe nach Norden
            
            INVENTAR:
            betrachte Inventar
            betrachte [Gegenstand] im Inventar
            benutze [Gegenstand] mit Tür
            
            SPIEL BEENDEN:
            Gib "ende" ein, um das Spiel zu beenden. Beachte, dass du nicht speichern kannst. Jedoch ist das Spiel
            auch nicht so lang. Viel Glück!
            TXT;

            if($verb == Verb::EAT)
                Out::info("Daf Fild ift ftärker alf deine Fähne.");

            if($verb == Verb::READ)
                Out::printLn($txt);
            if ($verb == Verb::LOOK)
                Out::info("Das Schild scheint eine Anleitung zu beinhalten.");
            if($verb == Verb::TAKE)
                Out::info("Das Schild ist festgeschraubt. Du kannst es nicht mitnehmen.");
        });

        // lies Schild
        $signSet = new HotKeySet($sign);
        $signSet
            ->addKey(Verb::READ)
            ->addKey(Verb::LOOK)
            ->addKey(Verb::TAKE)
            ->addKey(Verb::EAT)
        ;

        GameEngine::addHotKey($signSet);
    }

}