<?php

namespace App\Story\Items;


use App\Dictionary\Verb;
use App\System\Out;
use App\System\SceneObject;

class Medicine extends SceneObject
{


    public function __construct()
    {
        parent::__construct("medizin", "Dies ist Medizin gegen Übelkeit", function () {});
    }
}