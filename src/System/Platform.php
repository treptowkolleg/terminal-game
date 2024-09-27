<?php

namespace App\System;

enum Platform
{
    case WINDOWS;
    case LINUX;
    case MAC;

    public static function getClientSoftware(): Platform
    {
        if(str_contains(cli_get_process_title(),"exe")) {
            Out::printLn("Windows");
          return self::WINDOWS;
        } else {
            Out::printLn("Linux");
            return self::LINUX;
        }
    }


}
