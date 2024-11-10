<?php

namespace App\Story\Objects\TrainStation;

use App\Dictionary\Preposition;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Location\TrainStation;
use App\System\HotKeySet;
use App\System\Out;
use App\System\SceneObject;

class Stairs
{

    public static function down(): void
    {
        $stairs = new SceneObject("treppe","treppe",function(Verb $verb){
            if($verb == Verb::LOOK)
                Out::printLn("Die Treppe führt nach unten zum Eingang des Bahnhofs.");
            return false;
        });

        $key2 = new HotKeySet(Subject::DOWN);
        $key2->addKey(Verb::GO,$stairs,Preposition::TO,function (){return TrainStation::entrance();});


        $keys = new HotKeySet($stairs);
        $keys
            ->addKey(Verb::LOOK)
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
        $key2->addKey(Verb::GO,$stairs,Preposition::TO,function (){return TrainStation::platform();});


        $keys = new HotKeySet($stairs);
        $keys
            ->addKey(Verb::LOOK)
        ;

        GameEngine::addHotKey($keys);
        GameEngine::addHotKey($key2);
    }

}