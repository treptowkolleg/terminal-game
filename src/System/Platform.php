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
          return self::WINDOWS;
        } else {
            return self::LINUX;
        }
    }


}
