<?php

namespace App\Chars;

use App\GameEngine;
use App\Story\Scene;
use App\System\Char;
use App\System\Out;
use App\System\SceneObject;

class MsMuller extends Char
{
    public static int $count = 0;
    public static string $moodText = "";
    public static int $mood = 0;
    private static array $options = [];

    public static function setup(): void
    {
        $method = match(GameEngine::$scene) {
            Scene::PROLOG => "cafeteria",
            Scene::AULA => "dings",
            default => ""
        };
        self::run(self::class, $method);
    }

    public static int $dingsCount = 0;
    public static array $dingsTexts = [
        "Hey, du möchtest einen Kaffee? Hier, bitte sehr.",
        "Na gut, einen zweiten Kaffee gebe ich dir gern noch.",
        "Ich finde das ganz schön dreist! Mehr Kaffee gibt es für dich nicht!"
    ];
    public static function dings(): void
    {
        $text = <<<TXT
        Frau Müller wartet auf die Lernenden, um Ihnen Kaffee auszuschenken. Sie würde sich bestimmt
        freuen, wenn sie jemand in ein Gespräch verwickelt.
        TXT;

        Out::printLn($text);

        GameEngine::addAnswer(SceneObject::make("Einen Kaffee holen","1", function () {

            if(count(self::$dingsTexts) != 1) {
                Out::printLn(array_shift(self::$dingsTexts));
            } else {
                Out::printLn(self::$dingsTexts[0]);
            }
            return Scene::AULA;
        }));

    }

    public static function cafeteria(): void
    {
        self::$options = [
            0 => "Frau Müller ist heute besonders schlecht drauf.",
            1 => "Frau Müller ist heute besonders gut gelaunt."
        ];

        Char::randomize(self::$count, self::$options,self::$moodText);
        Char::print(self::$moodText);

        if(self::$count == 1) {
            GameEngine::addAnswer(
                SceneObject::make("Mit Frau Müller sprechen","1", function(){
                    MsMuller::$mood = 25;
                    return Scene::CAFETERIA_0101;
                })
            );
        }
    }

}