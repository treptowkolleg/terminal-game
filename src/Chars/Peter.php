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
                    Out::talk("Mann",$txt);
                    self::$counter++;
                    self::$talkedTo = true;
                } else {
                    Out::talk("Mann","Mir geht es wieder richtig blendend. Vielen Dank nochmals!");
                }
            }
            if($verb == Verb::USE and $subject instanceof Medicine) {
                if( Inventar::has(Medicine::class)) {
                    Out::talk("Mann","Wow, vielen Dank! Das wird mir auf jeden Fall helfen.");
                    Inventar::use(Medicine::class);
                    GameEngine::$quests++;

                    if(Inventar::collectable(Joint::class)) {
                        Out::info("Der Mann hat dir zum Dank einen medizinischen Joint geschenkt.");
                        Inventar::collect(Joint::class);
                    }
                }
            }
            if ($verb == Verb::USE and !($subject instanceof Medicine)) {
                Out::talk("Mann","Was soll ich denn damit?");
            }

            if ($verb == Verb::TAKE) {
                Out::talk("Mann","Zerr' nicht so an mir!");
            }
            if ($verb == Verb::LOOK) {
                Out::info("Dem Mann geht es offenbar sehr schlecht. Ob er etwas falsches gegessen hat?");
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