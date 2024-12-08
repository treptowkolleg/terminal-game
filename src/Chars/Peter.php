<?php

namespace App\Chars;

use App\Dictionary\Preposition;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Items\HomeKey;
use App\Story\Items\Joint;
use App\Story\Items\Medicine;
use App\System\HotKeySet;
use App\System\Inventar;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class Peter
{
    private static int $counter = 0;

    public static bool $talkedTo = false;

    public static function init(): void
    {
        $object =  new SceneObject("mann","Mann",function (Verb $verb, $subject, Preposition|null $prep){
            if($verb == Verb::TALK and $prep == Preposition::WITH){
                if(!Inventar::used(Medicine::class)) {
                    $txt = match (self::$counter) {
                        0 => "Man, ist mir schlecht. Ich glaube, ich brauche etwas dagegen!",
                        1 => "Kannst du mir ein Magenmittel besorgen?",
                        default => "Ich brauche dringend Medizin.",
                    };
                    Out::print("Mann: ");
                    Out::printLn($txt,TextColor::blue);
                    self::$counter++;
                    self::$talkedTo = true;
                } else {
                    Out::printLn("Mann: ");
                    Out::printLn("Mir geht es wieder richtig blendend. Vielen Dank nochmals!",TextColor::blue);
                }
            }
            if($verb == Verb::USE and $subject instanceof Medicine) {
                if( Inventar::has(Medicine::class)) {
                    Inventar::use($subject);
                    Out::printLn("Mann: ");
                    Out::printLn("Wow, vielen Dank! Das wird mir auf jeden Fall helfen.",TextColor::blue);

                    if(Inventar::collectable(Joint::class)) {
                        Out::printLn("\nDer Mann hat dir zum Dank einen medizinischen Joint geschenkt.");
                        Inventar::collect(Joint::class);
                    }
                }
            }
            if ($verb == Verb::USE and !($subject instanceof Medicine)) {
                Out::printLn("Mann: ");
                Out::printLn("Was soll ich denn damit?",TextColor::blue);
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

        foreach (GameEngine::$inventar as $item) {
            $keys->addKey(VERB::USE, $item, Preposition::WITH);
        }
        GameEngine::addHotKey($keys);
    }

}