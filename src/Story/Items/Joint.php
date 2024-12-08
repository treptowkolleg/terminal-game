<?php

namespace App\Story\Items;


use App\Dictionary\Verb;
use App\System\Out;
use App\System\SceneObject;

class Joint extends SceneObject
{


    public function __construct()
    {
        parent::__construct("joint", "Dies ist ein medizinisches Produkt, das zur Entspannung beiträgt.", function () {});
    }
}