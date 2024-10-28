<?php

namespace App\Dictionary;

enum DictState
{

    case PASS;
    case FAIL;
    case WRONG_VERB;
    case UNKNOWN_VERB;
    case WRONG_A;
    case UNKNOWN_A;
    case WRONG_B;
    case UNKNOWN_B;
    case WRONG_PREP;
    case UNKNOWN_PREP;

}
