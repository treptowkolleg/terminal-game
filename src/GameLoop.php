<?php

namespace App;

use App\Story\Cafeteria\CafeteriaChapterOne;
use App\Story\Text;
use App\Story\Scene;
use App\System\In;
use App\System\Out;

class GameLoop
{

    private Scene $scene = Scene::PROLOG;

    private static array $answers = [];

    public function start(): void
    {
        Out::clearView();
        while(true) {

            $this->scene = match($this->scene)
            {
                Scene::PROLOG => Text::prolog(),
                Scene::EPILOG => Text::end(),
                Scene::CAFETERIA_0101 => CafeteriaChapterOne::sceneA1()
            };

            if($this->scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

    public static function resetAnswers(): void
    {
        self::$answers = [];
    }

    public static function addAnswer(array $answer): void
    {
        self::$answers[] = $answer;
    }

    public static function getAnswers(): array
    {
        return self::$answers;
    }

    public static function printAnswers(): void
    {
        foreach (self::getAnswers() as $answer) {
            Out::printLn($answer['key'] . ": " . $answer['text']);
        }
    }

    public static function getInput(array $options = [])
    {
        if(!$options)
            $options = self::getAnswers();

        while (true) {
            $input = In::readLn();

            foreach ($options as $option) {
                if($option["key"] == $input) {
                    Out::clearView();
                    return call_user_func($option["action"]);
                }
            }
            if($input == "exit") return Scene::EXIT;
        }
    }

}