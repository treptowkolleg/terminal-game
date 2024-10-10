<?php

namespace App\Story;

use App\Chars\MrSchubert;
use App\Chars\MsMuller;
use App\GameLoop;
use App\System\In;
use App\System\Out;

class Text
{
    private static array $answers = [];

    public static function end(): Scene
    {
        Out::printLn("Das Spiel ist hier zu ende.");

        $input = readline("p für Szene Prolog: ");
        $input = strtolower($input);

        Out::clearView();

        if($input == "exit")    return Scene::EXIT;
        if($input == "p")       return Scene::PROLOG;

        return Scene::EPILOG;
    }

    public static function prolog(): Scene
    {
        Out::printHeading("Auf Abiwegen am Kolleg");
        In::readLn("weiter... ");

        // Array zurücksetzen
        self::$answers = [];

        // Array füllen
        if(MsMuller::$count == 0) self::$answers[] = [
            "text" => "Mit Frau Müller sprechen",
            "key" => "1",
            "action" => function () {
                // Frau Müllers Zähler erhöhen
                MsMuller::$count++;
                // Herrn Schuberts Zähler erniedrigen
                MrSchubert::$count--;
                // Zur nächsten Szene wechseln
                return Scene::CAFETERIA_0101;
            }
        ];

        $text = <<<TXT

        Du betrittst die Cafeteria des Treptow-Kollegs, wo der Duft von frisch gebackenem
        Brot und heißen Pommes in der Luft hängt. Die Tische sind gut gefüllt, und du bemerkst,
        dass einige Schüler über die neuesten Gerüchte austauschen.Hinter der Theke steht
        Frau Müller, die Köchin, die für ihre schmackhaften, aber manchmal merkwürdigen
        Gerichte bekannt ist. Heute scheint sie besonders gut gelaunt zu sein. Plötzlich
        hörst du einen lauten Streit zwischen einem Schüler und dem Hausmeister, Herrn Schubert,
        der gerade einen Mülleimer leeren will.
                
        TXT;

        Out::printLn($text);

        foreach (self::$answers as $answer) {
            Out::printLn($answer['key'] . ": " . $answer['text']);
        }

        return GameLoop::getInput(self::$answers);
    }

}