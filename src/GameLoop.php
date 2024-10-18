<?php

namespace App;

use App\Story\Cafeteria\CafeteriaChapterOne;
use App\Story\Text;
use App\Story\Scene;
use App\System\In;
use App\System\Out;
use App\System\SceneAnswer;

class GameLoop
{

    private Scene $scene = Scene::PROLOG;
    public static array $answers = [];

    public function start(): void
    {
        Out::clearView();
        while(true) {

            $this->scene = match($this->scene)
            {
                Scene::PROLOG => Text::prolog(),
                Scene::EPILOG => Text::end(),
                Scene::CAFETERIA_0101 => CafeteriaChapterOne::sceneA1(),
            };

            if($this->scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

    public static function resetAnswer(): void
    {
        self::$answers = [];
    }

    public static function addAnswer(SceneAnswer $answer): void
    {
        self::$answers[] = $answer;
    }

    public static function setAnswers(array $answers): void
    {
        self::$answers = $answers;
    }

    public static function printAnswers(): void
    {
        foreach(self::$answers as $answer) {
            if($answer instanceof SceneAnswer) {
                Out::printLn("{$answer->getKey()}: {$answer->getLabel()}");
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
                    // benutzerdefinierte Funktion ausführen (anonyme Funktion)
                    return call_user_func($answer->getCallback());
                }
                if($input == "exit") return Scene::EXIT;
            }
        }
    }

}