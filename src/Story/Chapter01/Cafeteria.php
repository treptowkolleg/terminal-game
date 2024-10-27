<?php

namespace App\Story\Chapter01;


use App\GameLoop;
use App\Story\Scene;
use App\System\Out;
use App\System\SceneAnswer;

class Cafeteria
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

        Out::printLn($text);

        GameLoop::addAnswer(SceneAnswer::make("Weggehen","1",function (){
            return Scene::AULA;
        }));

        return GameLoop::checkAnswers();
    }

    public static function aulaA1(): Scene
    {
        return GameLoop::checkAnswers();
    }

}