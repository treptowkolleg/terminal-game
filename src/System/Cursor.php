<?php

namespace App\System;

enum Cursor: string
{
    case blink = ("\033[5mblinking\033[0m");
    case hide = ("\033[?25l");
}
