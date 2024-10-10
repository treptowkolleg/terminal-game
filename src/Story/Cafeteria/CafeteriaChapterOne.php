<?php

namespace App\Story\Cafeteria;

use App\Chars\MsMuller;
use App\Story\Scene;
use App\System\In;
use App\System\Out;

class CafeteriaChapterOne
{

    public static function sceneA1(): Scene
    {


        $text = <<<TXT

        Du gehst zur Theke und fragst Frau Müller nach dem Rezept für ihr beliebtes Chili con Carne.
        Vielleicht kann sie dir einen Vorteil für die nächste Prüfung geben.
        
        Frau Müller lächelt, als du nach dem Rezept fragst.
        Sie gibt dir einige geheime Tipps und verrät dir, dass du eine Portion Chili für eine
        bevorstehende Klassenveranstaltung gewinnen kannst. Als Belohnung erhältst du einen Bonuspunkt
        für deine nächste Prüfung, wenn du das Gericht nachkochst und es bei der Veranstaltung präsentierst.
        
        TXT;

        while(true) {
            Out::printLn($text);

            switch (In::readLn()) {
                case "a":       return Scene::EPILOG;
                case "exit":    return Scene::EXIT;
            }
            Out::clearView();
        }
    }

}