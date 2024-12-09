<?php

namespace App\Dictionary;

/*
 * Beispiele:
 * Verb         Objekt A        Präposition     Objekt B
 * ----------------------------------------------------
 * untersuche                                   Ort/Gegend
 * sprich                       mit             (Frau) Müller
 * nimm                                         Schlüssel
 * benutze      Brief           mit             (Herrn) Schubert
 * benutze      Schlüssel       mit             Tür
 * kletter      Baum            nach            oben
 * kletter                      von             Baum
 * kletter                      auf             Baum
 * gehe                         nach            Norden
 */

enum Verb: string
{
    case TALK = "sprich";
    case TAKE = "nimm";
    case GO = "gehe";
    case ENTER = "betritt";
    case LEAVE = "verlasse";
    case OPEN = "öffne";
    case CLOSE = "schließe";
    case USE = "benutze";
    case READ = "lies";
    case LOOK = "betrachte";
    case CLIMB = "kletter";
    case EAT = "iss";
    case DRINK = "trinke";
    case VIEW = "umsehen";
    case EXIT = "ende";

}
