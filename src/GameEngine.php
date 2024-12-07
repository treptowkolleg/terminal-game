<?php

namespace App;

use App\Dictionary\Preposition;
use App\Dictionary\State;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use App\Story\Bonus\Names;
use App\Story\Items\HomeKey;
use App\Story\Scene;
use App\System\HotKey;
use App\System\HotKeySet;
use App\System\In;
use App\System\LocationMap;
use App\System\Out;
use App\System\SceneObject;
use App\System\TextColor;

class GameEngine
{

    public static string $player;
    public static Scene $scene = Scene::PROLOG;
    public static string $sceneTitle = "";
    public static string $sceneText = "";

    public static int $moves = 0;
    public static int $quests = 0;
    public static int $secrets = 0;

    public static string $map = "";

    public static bool $north = false;
    public static bool $east = false;
    public static bool $south = false;
    public static bool $west = false;
    public static bool $down = false;
    public static bool $up = false;

    public static array $inventar = [];

    /**
     * @var array<HotKeySet>
     */
    public static array $hotKeys = [];

    public function __construct()
    {
        $homeKey = new HomeKey();
        self::$inventar[] = $homeKey;
        self::resetHotKeys();
    }

    public static function setMap(
        bool $north = false,
        bool $east = false,
        bool $south = false,
        bool $west = false,
        bool $down = false,
        bool $up = false,): void
    {
        self::$north = $north;
        self::$east = $east;
        self::$south = $south;
        self::$west = $west;
        self::$down = $down;
        self::$up = $up;
    }

    public static function outputMap(): void
    {
        echo LocationMap::render(self::$north, self::$east, self::$south, self::$west, self::$down, self::$up). "\n\n";
    }

    public function __destruct()
    {
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

    public function start(): void
    {
        Out::clearView();
        $this->intro();
        while(true) {
            Scene::match(self::$scene);
        }
    }

    public static function stop(): void
    {
        exit(0);
    }

    public function intro(): void
    {
        date_default_timezone_set("Europe/Berlin");
        $hour = date("H");

        $wording = match (true) {
            $hour > 6 && $hour < 8 => "Es ist ziemlich früh. Du bist gestern wohl ziemlich früh ins Bett gegangen, oder?",
            $hour >= 8 && $hour < 12 => "Solltest du um diese Zeit nicht normalerweise arbeiten?",
            $hour >= 12 && $hour < 13 => "Eigentlich wäre es besser, wenn du in die Mittagspause gehst.",
            $hour <= 6 || $hour >= 23 => "Es ist mitten in der Nacht. Andere Leute schlafen für gewöhnlich um diese Zeit.\nNa gut, jetzt bin ich sowieso wach. Dann lass uns eine Runde zocken.",
            default => "Eine gute Zeit zum Zocken, oder?"
        };
        Out::clearView();
        Out::printLn("$wording\n");
        In::readLn("Enter drücken, um fortzufahren ...");
        Out::clearView();
        $input = explode(" ", In::readLn("Wie heißt du eigentlich? "));
        foreach ($input as &$word) {
            $word = ucfirst($word);
        }
        self::$player = implode(" ", $input);
        Names::match(self::$player);
    }

    public static function resetHotKeys(): void
    {
        self::$north = false;
        self::$east = false;
        self::$south = false;
        self::$west = false;
        self::$down = false;
        self::$up = false;
        self::$hotKeys = [];
        $view = new HotKeySet();
        $view->addKey(Verb::VIEW,callback: function (){
            Out::printLn(self::$sceneTitle,TextColor::green);
            Out::printLn(self::$sceneText);
        });

        $exit = new HotKeySet();
        $exit->addKey(Verb::EXIT,callback: function (){
            GameEngine::stop();
        });

        $inventar = new HotKeySet(Subject::INVENTAR);
        $inventar
            ->addKey(Verb::LOOK,callback: function (){
            Out::printLn("Du schleppst folgendes mit dir herum:");
            foreach (GameEngine::$inventar as $item) {
                if($item instanceof SceneObject) {
                    Out::printLn(ucfirst($item),TextColor::cyan);
                }
            }
        });

        foreach (self::$inventar as $item) {
            if($item instanceof SceneObject) {
                $inventar
                    ->addKey(Verb::LOOK, $item, Preposition::IN , function () use ($item) {
                    Out::printLn($item->getDescription());
                });
            }
        }

        self::$hotKeys = [$view, $inventar, $exit];
    }

    public static function addHotKey(HotKeySet $hotKey): void
    {
        self::$hotKeys[] = $hotKey;
    }

    public static function printHotkeys(): void
    {
        Out::printLn("");
        Out::printLn("DEBUG INFORMATION", TextColor::lightBlue);
        foreach(self::$hotKeys as $hotKeySet) {
            foreach($hotKeySet->getKeys() as $hotKey) {
                if($hotKey instanceof HotKey) {
                    Out::printOptionLn($hotKey->getVerb()->value . " " . $hotKey->getB(), $hotKey->getWordCount() ?? "", color: TextColor::lightBlue);
                }
            }
        }
    }

    public static function checkInput(): Scene
    {
        Out::clearView();
        $i = true;
        self::outputMap();
        while(true) {
            if($i) {
                Out::printLn(self::$sceneTitle, TextColor::green);
                Out::printLn(self::$sceneText);
                $i = false;
            }
            //self::printHotkeys();
            Out::printLn("");
            $input =  explode(" ", In::readLn());
            self::$moves++;
            $state = State::NOMATCH;
            Out::clearView();
            GameEngine::outputMap();
            foreach (self::$hotKeys as $hotKeySet) {
                foreach ($hotKeySet->getKeys() as $hotKey) {
                    if($hotKey instanceof HotKey) {
                        if(State::PASS == $state = $hotKey->checkPhrase($input)) {
                            $return = $hotKey->runAction();
                            if($return instanceof Scene) {
                                GameEngine::resetHotKeys();
                                return $return;
                            }
                            break 2;
                        }
                    }
                }
            }
            if($state == State::UNKNOWN_VERB) Out::printLn("Das Verb kenne ich leider nicht.");
            if($state == State::WRONG_VERB) Out::printLn("Das Verb kenne ich, funktioniert so aber nicht.");
            if($state == State::UNKNOWN_B || $state == State::WRONG_B) Out::printLn("Das Objekt ergibt hier keinen Sinn.");
            if($state == State::MISSING_PARAMETER) Out::printLn("Mir fehlt etwas mehr Kontext.");
            if($state == State::FAIL) Out::printLn("Da hat ja mal gar nichts gepasst!");
            if($input == "exit") return Scene::EXIT;
        }
    }

}