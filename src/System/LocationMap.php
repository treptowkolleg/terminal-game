<?php

namespace App\System;

use App\Dictionary\Verb;
use App\GameEngine;

class LocationMap
{

    public static function render(
        bool $north = false,
        bool $east = false,
        bool $south = false,
        bool $west = false,
        bool $down = false,
        bool $up = false,
        bool $portalN = false,
        bool $portalE = false,
        bool $portalS = false,
        bool $portalW = false,
        bool $person = false,
    ): string
    {
        $n = $north ? Out::string("N",TextColor::white, BackgroundColor::blue) : "N";
        $e = $east ?  Out::string("O",TextColor::white, BackgroundColor::blue) : "O";
        $s = $south ? Out::string("S",TextColor::white, BackgroundColor::blue) : "S";
        $w = $west ?  Out::string("W",TextColor::white, BackgroundColor::blue) : "W";
        $d = $down ?  Out::string("↘",TextColor::white, BackgroundColor::blue) : "↘";
        $u  = $up ?   Out::string("↗",TextColor::white, BackgroundColor::blue) : "↗";
        $pN = $portalN ? Out::string("↑",TextColor::white, BackgroundColor::blue) : "↑";
        $pE = $portalE ? Out::string("→",TextColor::white, BackgroundColor::blue) : "→";
        $pS = $portalS ? Out::string("↓",TextColor::white, BackgroundColor::blue) : "↓";
        $pW = $portalW ? Out::string("←",TextColor::white, BackgroundColor::blue) : "←";
        $person = $person ? Out::string("º",TextColor::white, BackgroundColor::green) : "º";
        $c = Out::blink("+");
        $moves = Out::string(GameEngine::$moves,TextColor::lightBlue);
        $q = Out::string(GameEngine::$quests,TextColor::lightBlue);
        $secrets = Out::string(GameEngine::$quests,TextColor::lightBlue);
        $verbs = "";
        foreach (Verb::cases() as $verb) {
            $verbs .= $verb->value . " | ";
        }
        $verbs = rtrim($verbs, " |");
        return "
     -$n-
    /   \\      | STATISTIK
   / $person$pN$u \\     | Schritte: $moves
  $w  $pW$c$pE  $e    | abgeschlossene Quests: $q
   \\  $pS$d /     | gefundene Secrets: $secrets
    \\   /      | Verben: $verbs
     -$s- 
    ";
    }

}