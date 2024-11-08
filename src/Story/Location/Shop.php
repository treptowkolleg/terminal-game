<?php

namespace App\Story\Location;

use App\Story\Scene;

class Shop
{

    public static function interior(): Scene
    {
        return Scene::EXIT;
    }

}