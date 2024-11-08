<?php

namespace App\Objects;

use App\Dictionary\PrepDict;
use App\Dictionary\VerbDict;
use App\Story\Location\TrainStation;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class PrologDoor
{
    public static bool $open = false;

    public static function get(): HotKeySet
    {
        $object =  new SceneObject("Tür","Tür",function (VerbDict $verb){
            $text = <<<TXT
            Diese Tür macht einen recht unscheinbaren Eindruck.
            TXT;

                $response = match ($verb) {
                    VerbDict::LOOK => $text,
                    VerbDict::TAKE => "Du kannst die Tür nicht mitnehmen.",
                    VerbDict::USE => "Die Tür fühlt sich nun ein wenig benutzt.",
                    default => "Das ergibt hier überhaupt keinen Sinn.",
                };

                if(self::$open){
                    if($verb == VerbDict::GO) return TrainStation::platform();
                    if($verb == VerbDict::OPEN) $response = "Die Tür ist doch schon offen.";
                    if($verb == VerbDict::CLOSE) {
                        $response = "Du hast die Tür geschlossen.";
                        self::$open = false;
                    }
                } else {
                    if($verb == VerbDict::GO) {
                        $response = "Willst du die Tür nicht lieber vorher öffnen?";
                    }
                    if($verb == VerbDict::CLOSE) $response = "Die Tür ist bereits zu.";
                    if($verb == VerbDict::OPEN) {
                        $response = "Du hast die Tür geöffnet.";
                        self::$open = true;
                    }
                }

                Out::printLn($response);
                return null;
            });

        $keys = new HotKeySet($object);
        $keys
            ->addKey(VerbDict::LOOK)
            ->addKey(VerbDict::TAKE)
            ->addKey(VerbDict::USE)
            ->addKey(VerbDict::OPEN)
            ->addKey(VerbDict::CLOSE)
            ->addKey(VerbDict::GO,null,PrepDict::THRU)
        ;

        return $keys;
    }

}