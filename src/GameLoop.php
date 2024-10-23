<?php

namespace App;

use App\Story\Scene;
use App\System\In;
use App\System\Out;
use App\System\SceneAnswer;
use App\System\TextColor;
use TypeError;

class GameLoop
{

    public static Scene $scene = Scene::PROLOG;
    public static array $answers = [];

    public function start(): void
    {
        Out::clearView();
        while(true) {
            Scene::match(self::$scene);
            if(self::$scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
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

    public static function setAnswers(array $answers): void
    {
        self::$answers = $answers;
    }

    public static function printAnswers(): void
    {
        foreach(self::$answers as $answer) {
            if($answer instanceof SceneAnswer) {
                Out::printOptionLn($answer->getKey(), $answer->getLabel(), color: TextColor::green);
            }
        }
    }

    public static function checkAnswers(): Scene
    {
        self::printAnswers();
        while(true) {
            // Benutzer-Abfrage
            $input = In::readLn();
            foreach (self::$answers as $answer) {
                if($answer instanceof SceneAnswer && $answer->getKey() == $input) {
                    // Antwortmöglichkeiten entfernen
                    self::resetAnswers();
                    // Bildschirm löschen
                    Out::clearView();
                    // benutzerdefinierte Funktion ausführen (anonyme Funktion)
                    try {
                        return call_user_func($answer->getCallback());
                    } catch (TypeError) {
                        exit(sprintf(
                            "Callback gibt keine Instanz von %s zurück!\nBetroffene Antwort: %s\n\n",
                            Scene::class, $answer->getLabel())
                        );
                    }
                }
                if($input == "exit") return Scene::EXIT;
            }
        }
    }

}