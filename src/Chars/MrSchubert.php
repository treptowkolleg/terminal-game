<?php

namespace App\Chars;

use App\GameEngine;
use App\Story\Scene;
use App\System\Char;
use App\System\Out;
use App\System\SceneObject;

class MrSchubert extends Char
{
    public static int $count = 0;

    public static function setup(): void
    {
        $method = match(GameEngine::$scene) {
            Scene::PROLOG => "cafeteria",
            default => ""
        };
        self::run(self::class, $method);
    }

    public static function cafeteria(): void
    {
        if(MsMuller::$count >= 0) {
            GameEngine::addAnswer(
                SceneObject::make(
                    "Den Streit zwischen Herrn Schubert und dem Schüler schlichten",
                    "schlichten",
                    function(){
                        Out::printLn("Herr Schubert gefällt das.");
                    }
                )
            );
        }
    }

}