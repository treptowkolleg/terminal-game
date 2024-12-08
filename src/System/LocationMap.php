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
        $n = $north ? Out::string("N",TextColor::white, BackgroundColor::blue) : Out::string("N",TextColor::lightGrey);
        $e = $east ?  Out::string("O",TextColor::white, BackgroundColor::blue) : Out::string("O",TextColor::lightGrey);
        $s = $south ? Out::string("S",TextColor::white, BackgroundColor::blue) : Out::string("S",TextColor::lightGrey);
        $w = $west ?  Out::string("W",TextColor::white, BackgroundColor::blue) : Out::string("W",TextColor::lightGrey);
        $d = $down ?  Out::string("↘",TextColor::white, BackgroundColor::blue) : Out::string("↘",TextColor::lightGrey);
        $u  = $up ?   Out::string("↗",TextColor::white, BackgroundColor::blue) : Out::string("↗",TextColor::lightGrey);
        $pN = $portalN ? Out::string("↑",TextColor::white, BackgroundColor::blue) : Out::string("↑",TextColor::lightGrey);
        $pE = $portalE ? Out::string("→",TextColor::white, BackgroundColor::blue) : Out::string("→",TextColor::lightGrey);
        $pS = $portalS ? Out::string("↓",TextColor::white, BackgroundColor::blue) : Out::string("↓",TextColor::lightGrey);
        $pW = $portalW ? Out::string("←",TextColor::white, BackgroundColor::blue) : Out::string("←",TextColor::lightGrey);
        $person = $person ? Out::string("º",TextColor::white, BackgroundColor::green) : Out::string("º",TextColor::lightGrey);
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
     _--$n--_       | STATISTIK
   /   $person$pN$u   \\     | Schritte: $moves
  $w    $pW$c$pE    $e    | abgeschlossene Quests: $q
   \\    $pS$d   /     | gefundene Secrets: $secrets
     °--$s--°       | Verben: $verbs
    ";
    }

}