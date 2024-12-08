<?php

namespace App\Chars;

use App\Dictionary\Preposition;
use App\Dictionary\Verb;
use App\GameEngine;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class Peter
{

    public static function init(): void
    {

        $object =  new SceneObject("mann","Mann",function (Verb $verb, $subject, Preposition|null $prep){
            $user = GameEngine::$player;
            if($verb == Verb::TALK and $prep == Preposition::WITH){
                Out::printLn("Hallo $user. Mir geht es nicht so gut. Ich benötige Medizin!");
            }
        });

        $keys = new HotKeySet($object);
        $keys
            ->addKey(Verb::TALK, null, Preposition::WITH)
        ;

        GameEngine::addHotKey($keys);
    }

}