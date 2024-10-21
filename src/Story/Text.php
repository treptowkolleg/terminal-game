<?php

namespace App\Story;

use App\Chars\MrSchubert;
use App\Chars\MsMuller;
use App\GameLoop;
use App\System\In;
use App\System\Out;
use App\System\SceneAnswer;

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

        $mm = "Heute scheint sie besonders gut gelaunt zu sein.";
        if(MsMuller::$count < 0)
            $mm = "Heute hat sie sehr schlechte Laune.";

        $text = <<<TXT

        Du betrittst die Cafeteria des Treptow-Kollegs, wo der Duft von frisch gebackenem
        Brot und heißen Pommes in der Luft hängt. Die Tische sind gut gefüllt, und du bemerkst,
        dass einige Schüler über die neuesten Gerüchte austauschen.Hinter der Theke steht
        Frau Müller, die Köchin, die für ihre schmackhaften, aber manchmal merkwürdigen
        Gerichte bekannt ist. $mm
        Plötzlich hörst du einen lauten Streit zwischen einem Schüler und dem Hausmeister,
        Herrn Schubert, der gerade einen Mülleimer leeren will.
                
        TXT;

        Out::clearView();
        Out::printLn($text);

        // Antwort instantiieren
        $ca3 = SceneAnswer::make("Sich umhören und das Gerücht erfragen","umsehen",function (){
            MrSchubert::$count--;
            return Scene::PROLOG;
        });

        // Antwort unter bestimmten Bedingungen hinzufügen
        if(MsMuller::$count >= 0) {
            GameLoop::addAnswer(
                SceneAnswer::make("Mit Frau Müller sprechen","1", function(){
                    MsMuller::$count++;
                    MrSchubert::$count--;
                    return "Okay";
                })
            );
        }

        // Antworten zum Array hinzufügen
        GameLoop::addAnswers([
            SceneAnswer::make("Den Streit zwischen Herrn Schubert und dem Schüler schlichten","schlichten",function(){
                return Scene::CAFETERIA_0102;
            }),
            $ca3
        ]);

        return GameLoop::checkAnswers();
    }

}