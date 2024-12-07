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
    ): string
    {
        $n = $north ? Out::string("N",TextColor::white, BackgroundColor::blue) : "N";
        $e = $east ?  Out::string("O",TextColor::white, BackgroundColor::blue) : "O";
        $s = $south ? Out::string("S",TextColor::white, BackgroundColor::blue) : "S";
        $w = $west ?  Out::string("W",TextColor::white, BackgroundColor::blue) : "W";
        $d = $down ?  Out::string("↘",TextColor::white, BackgroundColor::blue) : "↘";
        $u  = $up ?   Out::string("↗",TextColor::white, BackgroundColor::blue) : "↗";
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
    --$n--      | STATISTIK
   /   $u \\     | Schritte: $moves
  $w   $c   $e    | abgeschlossene Quests: $q
   \\   $d /     | gefundene Secrets: $secrets
    --$s--      | Verben: $verbs
    ";
    }

}