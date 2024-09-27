<?php

namespace App;

use App\Story\Text;
use App\Story\Scene;
use App\System\Out;
use App\System\Platform;

class GameLoop
{

    private Scene $scene = Scene::PROLOG;

    public static Platform $platform;

    public function __construct()
    {
        self::$platform = Platform::getClientSoftware();
    }


    public function start(): void
    {
        Out::clearView();

        while(true) {

            $this->scene = match($this->scene)
            {
                Scene::PROLOG => Text::prolog(),
                Scene::EPILOG => Text::end(),
            };

            if($this->scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

}