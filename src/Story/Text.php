<?php

namespace App\Story;

use App\Chars\MrSchubert;
use App\Chars\MsMuller;
use App\GameLoop;
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

        // Auch nach Char verschieben?


        /*
         * Nur allgemeine Szenenbeschreibung; alles was Personen betrifft bedingt über die Methoden der jeweiligen
         * Personen ausgeben. Entweder direkt, oder über ein Kommando (umsehen?).
         *
         * Dann sowas wie: GameLoop::addChars(MsMuller, MrSchubert);
         * Dann: foreach Chars as Char ... bla, bla, bla, ... char::setup();
         *
         * Hier würde ich GameLoop.php auch inzwischen in GameEngine.php umbenennen, da Engine hier das bessere
         * Wort ist. Denn dieses Objekt verwaltet nun sämtliche Szenen und Charaktere. Oder?
         */
        $text = <<<TXT

        Du betrittst die Cafeteria des Treptow-Kollegs, wo der Duft von frisch gebackenem
        Brot und heißen Pommes in der Luft hängt. Die Tische sind gut gefüllt, und du bemerkst,
        dass einige Schüler über die neuesten Gerüchte austauschen.Hinter der Theke steht
        Frau Müller, die Köchin, die für ihre schmackhaften, aber manchmal merkwürdigen
        Gerichte bekannt ist.
        Plötzlich hörst du einen lauten Streit zwischen einem Schüler und dem Hausmeister,
        Herrn Schubert, der gerade einen Mülleimer leeren will.
                
        TXT;

        Out::clearView();
        Out::printLn($text);

        MsMuller::setup();
        MrSchubert::setup();
        return GameLoop::checkAnswers();
    }

}