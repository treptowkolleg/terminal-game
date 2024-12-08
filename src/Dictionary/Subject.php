<?php

namespace App\Dictionary;

enum Subject: string
{
    case NORTH = "norden";
    case EAST = "osten";
    case SOUTH = "süden";
    case WEST = "westen";
    case UP = "oben";
    case DOWN = "unten";

    case KEY = "schlüssel";
    case INVENTAR = "inventar";

}
