<?php

namespace App;

use App\Dictionary\DictState;
use App\Dictionary\PrepDict;
use App\Dictionary\SubjectDict;
use App\Dictionary\VerbDict;
use App\Story\Scene;
use App\System\HotKey;
use App\System\HotKeySet;
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

    /**
     * @var array<HotKeySet>
     */
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
        $view = new HotKeySet();
        $view->addKey(VerbDict::VIEW,callback: function (){
            Out::printLn(self::$sceneTitle,TextColor::green);
            Out::printLn(self::$sceneText);
        });

        $exit = new HotKeySet();
        $exit->addKey(VerbDict::EXIT,callback: function (){
            GameEngine::stop();
        });

        self::$hotKeys = [$view, $exit];
    }

    public static function addAnswer(SceneObject $answer): void
    {
        self::$answers[] = $answer;
    }

    public static function addHotKey(HotKeySet $hotKey): void
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
            $state = DictState::NOMATCH;
            $newState = null;
            foreach (self::$hotKeys as $hotKeySet) {
                foreach ($hotKeySet->getKeys() as $hotKey) {
                    if($hotKey instanceof HotKey) {
                        if(DictState::PASS == $state = $hotKey->checkPhrase($input)) {
                            $return = $hotKey->runAction();
                            if($return instanceof Scene) return $return;
                            break 2;
                        }
                    }
                }
            }
            if($state == DictState::UNKNOWN_VERB) Out::printLn("Das Verb kenne ich leider nicht.");
            if($state == DictState::WRONG_VERB) Out::printLn("Das Verb kenne ich, funktioniert so aber nicht.");
            if($state == DictState::UNKNOWN_B || $state == DictState::WRONG_B) Out::printLn("Das Objekt ergibt hier keinen Sinn.");
            if($state == DictState::MISSING_PARAMETER) Out::printLn("Mir fehlt etwas mehr Kontext.");
            if($state == DictState::FAIL) Out::printLn("Da hat ja mal gar nichts gepasst!");
            if($input == "exit") return Scene::EXIT;
        }
    }

}