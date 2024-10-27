<?php

namespace App\Chars;

use App\GameLoop;
use App\Story\Scene;
use App\System\Char;
use App\System\Out;
use App\System\SceneAnswer;

class MrSchubert extends Char
{
    public static int $count = 0;

    public static function setup(): void
    {
        $method = match(GameLoop::$scene) {
            Scene::PROLOG => "cafeteria",
            default => ""
        };
        self::run(self::class, $method);
    }

    public static function cafeteria(): void
    {
        if(MsMuller::$count >= 0) {
            GameLoop::addAnswer(
                SceneAnswer::make(
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