<?php

namespace App;

use App\Dictionary\DictState;
use App\Dictionary\PrepDict;
use App\Dictionary\SubjectDict;
use App\Dictionary\VerbDict;
use App\Story\Scene;
use App\System\HotKey;
use App\System\In;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class GameEngine
{

    public static Scene $scene = Scene::PROLOG;
    public static string $sceneTitle = "";
    public static string $sceneText = "";
    public static array $answers = [];
    public static array $hotKeys = [];

    public function __construct()
    {
        self:self::resetHotKeys();
    }

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

    public static function resetHotKeys(): void
    {
        self::$hotKeys = [
            new HotKey(VerbDict::VIEW,callback: function (){
            Out::printLn(self::$sceneTitle,TextColor::green);
            Out::printLn(self::$sceneText);
            }),
            new HotKey(VerbDict::EXIT,callback: function (){
                GameEngine::stop();
            })
        ];
    }

    public static function addAnswer(SceneObject $answer): void
    {
        self::$answers[] = $answer;
    }

    public static function addHotKey(HotKey $hotKey): void
    {
        self::$hotKeys[] = $hotKey;
    }

    public static function addAnswers(array $answers): void
    {
        self::$answers = array_merge(self::$answers, $answers);
    }

    public static function printAnswers(): void
    {
        Out::printLn("");
        foreach(self::$answers as $answer) {
            if($answer instanceof SceneObject) {
                Out::printOptionLn($answer->getDescription(), $answer->getLabel(), color: TextColor::green);
            }
        }
    }

    public static function checkInput(): Scene
    {
        Out::clearView();
        Out::printLn(self::$sceneTitle,TextColor::green);
        Out::printLn(self::$sceneText);
        while(true) {
            Out::printLn("");
            $input =  explode(" ", In::readLn());
            foreach (self::$hotKeys as $hotKey) {
                if($hotKey instanceof HotKey) {
                    if(DictState::PASS == $hotKey->checkPhrase($input)) {
                        if($hotKey->hasA()) call_user_func($hotKey->getA()->getCallback());
                        if($hotKey->hasB()) call_user_func($hotKey->getB()->getCallback());
                        $return = call_user_func($hotKey->getCallback());
                        if($return instanceof Scene) return $return;
                        break;
                    }
                }
            }
            if($input == "exit") return Scene::EXIT;
        }
    }

}