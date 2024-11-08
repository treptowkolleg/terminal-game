<?php

namespace App\Story\Location\School;

use App\Story\Scene;

class Entrance
{

    public static function interior(): Scene
    {
        return Scene::EXIT;
    }

}