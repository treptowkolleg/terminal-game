<?php

namespace App\Chars;

use App\Dictionary\Preposition;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Items\Medicine;
use App\System\HotKeySet;
use App\System\Inventar;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class Pharmacist
{

    public static function init(): void
    {

        $object =  new SceneObject("apothekerin","apothekerin",function (Verb $verb, $subject, Preposition|null $prep){
            if($verb == Verb::TALK){
                if(Peter::$talkedTo) {
                    if(Inventar::collectable(Medicine::class)) {
                        Out::print("Apothekerin: ");
                        Out::printLn("Du benötigst etwas gegen Übelkeit? Glücklicherweise habe ich noch eine Packung vorrätig.\nBitte sehr.",TextColor::blue);
                        Inventar::collect(Medicine::class);
                    } else {
                        Out::print("Apothekerin: ");
                        Out::printLn("Mehr als eine Packung hatte ich leider nicht vorrätig.",TextColor::blue);
                    }
                } else {
                    Out::printLn("Dir fällt nicht ein, was du aus der Apotheke kaufen willst.");
                }
            }
            if ($verb == Verb::LOOK) {
                Out::printLn("Die Apothekerin macht einen sehr kompetenten und freundlichen Eindruck.");
            }
        });

        $keys = new HotKeySet($object);
        $keys
            ->addKey(Verb::TALK, null, Preposition::WITH)
            ->addKey(Verb::LOOK)
        ;

        GameEngine::addHotKey($keys);
    }

}