<?php

namespace App\Chars;

use App\GameLoop;
use App\Story\Scene;
use App\System\Out;
use App\System\SceneAnswer;

class MsMuller extends AbstractCharacter
{
    public static int $count = 0;
    public static string $moodText = "";

    public static int $mood = 0;

    private static array $options = [];

    public static function setup(): void
    {
        $scene = match(GameLoop::$scene) {
            Scene::PROLOG => "cafeteria",
            Scene::AULA => "dings",
            default => ""
        };
        if($scene)
            call_user_func([self::class,$scene]);
    }

    private static function dings()
    {
        self::$moodText = "Frau Müller wartet auf die Lernenden, um Ihnen Kaffee auszuschenken.";
        self::printMoodText();

    }

    private static function cafeteria(): void
    {
        self::$options = [
            0 => "Frau Müller ist heute besonders schlecht drauf",
            1 => "Frau Müller ist heute besonders gut gelaunt"
        ];

        self::$count = rand(0,count(self::$options)-1);
        self::$moodText = self::$options[self::$count];

        self::printMoodText();

        if(self::$count == 1) {
            GameLoop::addAnswer(
                SceneAnswer::make("Mit Frau Müller sprechen","1", function(){
                    MsMuller::$mood = 25;
                    MrSchubert::$count--;
                    return Scene::CAFETERIA_0101;
                })
            );
        }
    }

    private static function printMoodText(): void
    {
        if(self::$moodText)
            Out::printLn(self::$moodText);
    }

}