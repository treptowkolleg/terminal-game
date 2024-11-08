<?php

namespace App\Story\Items;


use App\Dictionary\Verb;
use App\System\Out;
use App\System\SceneObject;

class HomeKey extends SceneObject
{


    public function __construct()
    {
        parent::__construct("wohnungsschlüssel", "Dies ist dein Wohnungsschlüssel", function () {});
    }
}