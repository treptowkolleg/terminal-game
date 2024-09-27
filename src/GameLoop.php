<?php

namespace App;

use App\Story\Text;
use App\Story\Scene;
use App\System\Out;

class GameLoop
{

    private Scene $scene = Scene::PROLOG;

    public static string $cli;

    public function __construct()
    {
        // Überprüfen, welches Command-Line-Interface verwendet wird:
        if(str_contains(cli_get_process_title(),"exe")) {
            self::$cli = "windows";
        } else {
            self::$cli = "linux";
        }
    }


    public function start(): void
    {
        Out::clearView();
        // TODO: Statt der Nummern könnte man die Szenen auch mit einer Enum definieren.
        while (true) {

            $this->scene = match($this->scene) {
                Scene::PROLOG => Text::prolog(),
                Scene::EPILOG => Text::end(),
            };

            if($this->scene === Scene::EXIT) break;
        }
        Out::clearView();
        Out::printHeading("Das Spiel wurde beendet!");
    }

}