<?php

namespace App\Story\Objects\TrainStation;

use App\Dictionary\Preposition;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Scene;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class Stairs
{

    public static function down(): void
    {
        $stairs = new SceneObject("treppe","treppe",function(Verb $verb){
            $player = GameEngine::$player;

            $text = match ($verb){
                Verb::LOOK => "Die Treppe führt nach unten zum Eingang des Bahnhofs.",
                Verb::TAKE => "$player, dein Rucksack ist etwas zu klein für diese Treppe.",
                Verb::USE => "Benutze lieber Verben der Bewegung, um irgendwo hinzugehen.",
                default => false
            };

            if($text) Out::printLn($text);
        });

        $key2 = new HotKeySet(Subject::DOWN);
        $key2->addKey(Verb::GO,$stairs,Preposition::TO,function (){return Scene::TRAIN_STATION_ENTRANCE;});
        $key2->addKey(Verb::GO,null,Preposition::TO,function (){return Scene::TRAIN_STATION_ENTRANCE;});


        $keys = new HotKeySet($stairs);
        $keys
            ->addKey(Verb::LOOK)
            ->addKey(Verb::TAKE)
            ->addKey(Verb::USE)
        ;

        GameEngine::addHotKey($keys);
        GameEngine::addHotKey($key2);
    }

    public static function up(): void
    {
        $stairs = new SceneObject("treppe","treppe",function(Verb $verb){
            if($verb == Verb::LOOK)
                Out::printLn("Die Treppe führt nach oben zum Bahnsteig.");
            return false;
        });

        $key2 = new HotKeySet(Subject::UP);
        $key2->addKey(Verb::GO,$stairs,Preposition::TO,function (){return Scene::TRAIN_STATION_PLATFORM;});
        $key2->addKey(Verb::GO,null,Preposition::TO,function (){return Scene::TRAIN_STATION_PLATFORM;});


        $keys = new HotKeySet($stairs);
        $keys
            ->addKey(Verb::LOOK)
        ;

        GameEngine::addHotKey($keys);
        GameEngine::addHotKey($key2);
    }

}