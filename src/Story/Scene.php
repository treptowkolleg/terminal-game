<?php

namespace App\Story;

use App\Story\Cafeteria\CafeteriaChapterOne;

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
            Scene::PROLOG => Text::prolog(),
            Scene::EPILOG => Text::end(),
            Scene::CAFETERIA_0101 => CafeteriaChapterOne::sceneA1(),
        };
    }

}
