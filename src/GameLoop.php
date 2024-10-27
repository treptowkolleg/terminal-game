<?php

namespace App;

use App\Story\Scene;
use App\System\In;
use App\System\Out;
use App\System\SceneAnswer;
use App\System\TextColor;

class GameLoop
{

    public static Scene $scene = Scene::PROLOG;
    public static array $answers = [];

    public function __destruct()
    {
        Out::printHeading("Das Spiel wurde beendet!");
    }

    public function start(): void
    {
        Out::clearView();
        while(true) {
            Scene::match(self::$scene);
        }
    }

    public static function stop(): void
    {
        exit(0);
    }

    public static function resetAnswers(): void
    {
        self::$answers = [];
    }

    public static function addAnswer(SceneAnswer $answer): void
    {
        self::$answers[] = $answer;
    }

    public static function addAnswers(array $answers): void
    {
        self::$answers = array_merge(self::$answers, $answers);
    }

    public static function printAnswers(): void
    {
        Out::printLn("");
        foreach(self::$answers as $answer) {
            if($answer instanceof SceneAnswer) {
                Out::printOptionLn($answer->getKey(), $answer->getLabel(), color: TextColor::green);
            }
        }
    }

    public static function checkAnswers(): Scene
    {
        while(true) {

            /** @deprecated Antworten werden künftig nicht mehr ausgegeben! */
            self::printAnswers();

            // Benutzer-Abfrage
            $input = In::readLn();
            foreach (self::$answers as $answer) {
                if($answer instanceof SceneAnswer && $answer->getKey() == $input) {
                    $return = call_user_func($answer->getCallback());
                    if($return instanceof Scene) {
                        self::resetAnswers();
                        Out::clearView();
                        return $return;
                    }
                    break;
                }
            }
            if($input == "exit") return Scene::EXIT;
        }
    }

}