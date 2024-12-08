<?php

namespace App\Chars;

use App\Dictionary\Preposition;
use App\Dictionary\Verb;
use App\GameEngine;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class Peter
{
    private static int $counter = 0;

    public static function init(): void
    {

        $object =  new SceneObject("mann","Mann",function (Verb $verb, $subject, Preposition|null $prep){
            if($verb == Verb::TALK and $prep == Preposition::WITH){
                $txt = match (self::$counter) {
                    0 => "Man, ist mir schlecht. Ich glaube, ich brauche etwas dagegen!",
                    1 => "Kannst du mir ein Magenmittel besorgen?",
                    default => "Ich brauche dringend Medizin.",
                };
                Out::print("Mann: ");
                Out::printLn($txt,TextColor::blue);
                self::$counter++;
            }
            if ($verb == Verb::TAKE) {
                Out::print("Mann: ");
                Out::printLn("Zerr' nicht so an mir!", TextColor::blue);
            }
            if ($verb == Verb::LOOK) {
                Out::printLn("Dem Mann geht es offenbar sehr schlecht. Ob er etwas falsches gegessen hat?");
            }
        });

        $keys = new HotKeySet($object);
        $keys
            ->addKey(Verb::TALK, null, Preposition::WITH)
            ->addKey(Verb::TAKE)
            ->addKey(Verb::LOOK)
        ;

        GameEngine::addHotKey($keys);
    }

}