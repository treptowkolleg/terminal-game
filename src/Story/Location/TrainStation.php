<?php

namespace App\Story\Location;

use App\Story\Scene;

class TrainStation
{

    public static function entrance(): Scene
    {

        return Scene::EXIT;
    }

    public static function platform(): Scene
    {

        return Scene::EXIT;
    }

}