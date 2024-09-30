<?php

namespace App\Story;

use App\System\In;
use App\System\Out;

class Text
{

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

        $text = <<<TXT

        Du betrittst die Cafeteria des Treptow-Kollegs, wo der Duft von frisch gebackenem
        Brot und heißen Pommes in der Luft hängt. Die Tische sind gut gefüllt, und du bemerkst,
        dass einige Schüler über die neuesten Gerüchte austauschen.Hinter der Theke steht
        Frau Müller, die Köchin, die für ihre schmackhaften, aber manchmal merkwürdigen
        Gerichte bekannt ist. Heute scheint sie besonders gut gelaunt zu sein. Plötzlich
        hörst du einen lauten Streit zwischen einem Schüler und dem Hausmeister, Herrn Schubert,
        der gerade einen Mülleimer leeren will.
        
        1: Mit Frau Müller sprechen
        2: Den Streit zwischen Herrn Schubert und dem Schüler schlichten
        3: Sich umhören und das Gerücht erfragen
        
        TXT;

        Out::printLn($text);
        $input = In::readLn();

        Out::clearView();

        if($input == "exit")    return Scene::EXIT;
        if($input == "1")       return Scene::CAFETERIA_0101;

        return Scene::PROLOG;
    }

}