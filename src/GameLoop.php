<?php

namespace App;

use App\Story\Cafeteria\CafeteriaChapterOne;
use App\Story\Text;
use App\Story\Scene;
use App\System\Out;

class GameLoop
{

    private Scene $scene = Scene::PROLOG;

    public function start(): void
    {
        Out::clearView();
        while(true) {

            $this->scene = match($this->scene)
            {
                Scene::PROLOG => Text::prolog(),
                Scene::EPILOG => Text::end(),
                Scene::CAFETERIA_0101 => CafeteriaChapterOne::sceneA1()
            };

            if($this->scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

}