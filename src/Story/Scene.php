<?php

namespace App\Story;

use App\GameLoop;
use App\Story\Chapter01\Cafeteria;
use App\Story\Chapter01\Prolog;

enum Scene
{
    case CAFETERIA;
    case CAFETERIA_0101;
    case CAFETERIA_0102;
    case YARD;
    case AULA;
    case PROLOG;
    case EPILOG;
    case EXIT;

    public static function match(Scene &$scene): void
    {
        $scene = match($scene)
        {
            Scene::PROLOG => Prolog::prolog(),
            Scene::EPILOG => Prolog::end(),
            Scene::CAFETERIA_0101 => Cafeteria::sceneA1(),
            Scene::AULA => Cafeteria::aulaA1(),
            Scene::EXIT => GameLoop::stop()
        };
    }

}
