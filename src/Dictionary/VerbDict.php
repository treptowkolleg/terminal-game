<?php

namespace App\Dictionary;

/*
 * Beispiele:
 * Verb     Objekt A        Präposition     Objekt B
 * ----------------------------------------------------
 * sprich                   mit             (Frau) Müller
 * nimm     Schlüssel
 * benutze  Brief           mit             (Herrn) Schubert
 * benutze  Schlüssel       mit             Tür
 * kletter  Baum            nach            oben
 * kletter                  von             Baum
 * kletter                  auf             Baum
 * gehe                     nach            Norden
 */

enum VerbDict: string
{
    case TALK = "sprich";
    case TAKE = "nimm";
    case GOTO = "gehe";
    case USE = "benutze";
    case READ = "lies";
    case LOOK = "untersuche";
    case CLIMB = "kletter";

}
