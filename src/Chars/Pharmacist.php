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
                        Out::talk("Apothekerin","Du benötigst etwas gegen Übelkeit? Glücklicherweise habe ich noch eine Packung vorrätig.");
                        Inventar::collect(Medicine::class);
                    } else {
                        Out::talk("Apothekerin","Mehr als eine Packung hatte ich leider nicht vorrätig.");
                    }
                } else {
                    Out::info("Dir fällt nicht ein, was du aus der Apotheke kaufen willst.");
                }
            }
            if ($verb == Verb::LOOK) {
                Out::info("Die Apothekerin macht einen sehr kompetenten und freundlichen Eindruck.");
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