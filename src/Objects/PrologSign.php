<?php

namespace App\Objects;

use App\Dictionary\VerbDict;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class PrologSign
{

    public static function get(): HotKeySet
    {
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

        return $signSet;
    }

}