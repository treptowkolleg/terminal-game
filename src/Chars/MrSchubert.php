<?php

namespace App\Chars;

use App\GameLoop;
use App\Story\Scene;
use App\System\SceneAnswer;

class MrSchubert extends Char
{
    public static int $count = 0;

    public static function setup(): void
    {
        $scene = match(GameLoop::$scene) {
            Scene::PROLOG => "cafeteria",
            default => ""
        };
        if($scene)
            call_user_func([self::class,$scene]);
    }

    private static function cafeteria(): void
    {
        if(MsMuller::$count >= 0) {
            GameLoop::addAnswer(
                SceneAnswer::make(
                    "Den Streit zwischen Herrn Schubert und dem Schüler schlichten",
                    "schlichten",
                    function(){
                        return Scene::CAFETERIA_0102;
                    }
                )
            );
        }
    }

}