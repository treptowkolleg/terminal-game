<?php

namespace App\Story\Location\School;

use App\Story\Scene;

class SchoolGarden
{

    public static function north(): Scene
    {
        return Scene::EXIT;
    }

    public static function south(): Scene
    {
        return Scene::EXIT;
    }

    public static function east(): Scene
    {
        return Scene::EXIT;
    }

}