<?php

namespace App\Story\Objects\Prolog;

use App\Dictionary\Preposition;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Items\HomeKey;
use App\Story\Scene;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class PrologDoor
{
    public static bool $open = false;

    public static function init(): void
    {
        $object =  new SceneObject("Tür","Tür",function (Verb $verb, $subject, Preposition|null $prep){
            $text = <<<TXT
            Diese Tür macht einen recht unscheinbaren Eindruck.
            TXT;

            $player = GameEngine::$player;

            $response = match ($verb) {
                Verb::LOOK => $text,
                Verb::TAKE => "Was hat dir die Tür eigentlich getan? Schäm' dich, $player!",
                Verb::USE => "Die Tür fühlt sich jetzt ein wenig benutzt.",
                Verb::EAT => "$player, das solltest du wirklich nicht tun.",
                default => "Das ergibt hier überhaupt keinen Sinn.",
            };

            if($verb == Verb::USE && $subject instanceof HomeKey && $prep == Preposition::WITH) {
                foreach (GameEngine::$inventar as $item) {
                    if($item instanceof HomeKey) {
                        $response = "Das ist zwar ein Schlüssel, jedoch hat diese Tür kein Schlüsselloch.";
                        break;
                    } else {
                        $response = "Du hast keinen Schlüssel. Davon mal abgesehen hat die Tür auch kein Schlüsselloch.";
                    }
                }

            }

            if(self::$open){
                if($verb == Verb::GO) return Scene::TRAIN_STATION_PLATFORM;
                if($verb == Verb::OPEN) $response = "Die Tür ist doch schon offen.";
                if($verb == Verb::CLOSE) {
                    $response = "Du hast die Tür geschlossen.";
                    self::$open = false;
                }
            } else {
                if($verb == Verb::GO) {
                    $response = "Willst du die Tür nicht lieber vorher öffnen?";
                }
                if($verb == Verb::CLOSE) $response = "Die Tür ist bereits zu.";
                if($verb == Verb::OPEN) {
                    $response = "Du hast die Tür geöffnet.";
                    self::$open = true;
                }
            }

            Out::info($response);
            return null;
        });

        $keys = new HotKeySet($object);
        $keys
            ->addKey(Verb::EAT)
            ->addKey(Verb::LOOK)
            ->addKey(Verb::TAKE)
            ->addKey(Verb::USE)
            ->addKey(Verb::OPEN)
            ->addKey(Verb::CLOSE)
            ->addKey(Verb::GO,null,Preposition::THRU)
            ->addKey(Verb::USE, new HomeKey(), Preposition::WITH)
        ;

        GameEngine::addHotKey($keys);
    }

}
