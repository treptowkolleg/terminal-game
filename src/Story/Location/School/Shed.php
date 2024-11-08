<?php

namespace App\Story\Location\School;

use App\Story\Scene;

class Shed
{

    public static function interior(): Scene
    {
        return Scene::EXIT;
    }

    public static function exterior(): Scene
    {
        return Scene::EXIT;
    }

}