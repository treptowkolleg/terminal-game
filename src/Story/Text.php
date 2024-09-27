<?php

namespace App\Story;

use App\System\Out;
use App\System\TextColor;

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
        $text = <<<TXT

Du betrittst die Cafeteria des Treptow-Kollegs, wo der Duft von frisch gebackenem
Brot und heißen Pommes in der Luft hängt. Die Tische sind gut gefüllt, und du bemerkst,
dass einige Schüler über die neuesten Gerüchte austauschen.Hinter der Theke steht
Frau Müller, die Köchin, die für ihre schmackhaften, aber manchmal merkwürdigen
Gerichte bekannt ist. Heute scheint sie besonders gut gelaunt zu sein.

Plötzlich hörst du einen lauten Streit zwischen einem Schüler und dem Hausmeister,
Herrn Schubert, der gerade einen Mülleimer leeren will.

TXT;

        Out::printLn($text,TextColor::green);
        $input = readline("a für Szene Ende: ");
        $input = strtolower($input);


        Out::clearView();

        if($input == "exit")    return Scene::EXIT;
        if($input == "a")       return Scene::EPILOG;

        return Scene::PROLOG;
    }

}