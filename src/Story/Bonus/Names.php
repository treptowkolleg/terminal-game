<?php

namespace App\Story\Bonus;

use App\System\In;
use App\System\Out;

class Names
{

    public static function match(string $name): void
    {
        foreach (self::getNameList() as $method => $listNames) {
            foreach ($listNames as $listName) {
                if (str_contains(strtolower($name), $listName)) {
                    $txt = call_user_func("self::$method");
                    Out::clearView();
                    Out::printLn("$txt\n");
                    In::readLn("Drücke Enter, um fortzufahren ... ");
                    break 2;
                }
            }

        }
    }

    private static function getNameList(): array
    {
        return [
          "woyzeck" => ["woyzeck", "woydzeck"],
            "newton" => ["newton", "isaac"],
            "einstein" => ["einstein", "albert"],
        ];
    }

    private static function woyzeck(): string
    {
        return <<<TXT
        Ah, du hast dich also freiwillig für den Namen Woyzeck entschieden? Interessant, mutig – oder sagen wir
        lieber: fatalistisch. Da nimmt man einen Namen, der quasi in allen Sprachen „die Person mit dem schlechtesten
        Karma“ schreit, und hofft vermutlich, dass das Schicksal ein bisschen gnädig ist. Herzlichen Glückwunsch,
        du bist nun offiziell der Held der Fußnoten: Überall wirst du erwähnen dürfen, wie "Dinge eben einfach
        schiefgehen", wenn der Name Woyzeck im Spiel ist.

        Aber keine Sorge, das bringt immerhin Schwung in den Alltag! Wo andere ganz fade ein Abenteuer bestreiten,
        stolperst du glamourös die Kellertreppe hinunter, verlierst dein Equipment in einer epischen Pfütze, und wenn
        irgendwo eine Tür zuknallt, ist klar, wer mal wieder den Schlüssel auf der falschen Seite gelassen hat.
        Ein echtes Woyzeck-Dasein: Was für den normalen Abenteurer ein Ärgernis wäre, ist für dich eine Tugend.
        Also viel Spaß dabei – und denk dran, in deinem Fall ist „Pechvogel“ eher eine Karrierebezeichnung!
        
        Ich hoffe nur, dass du mich nicht abstichst, sobald dir das Spiel zu schwierig wird.
        TXT;
    }

    private static function newton(): string
    {
        return <<<TXT
        Ah, du hast dich also freiwillig für den Namen Isaac Newton entschieden? Wie nobel von dir! Offensichtlich
        wolltest du nicht nur ein bisschen Klugheit, sondern gleich die Lizenz zum Apfelwerfen.
        Jetzt aber ehrlich – jeder weiß, dass Newtons Leben nicht nur aus Glanz und Gravitation bestand.
        Mach dich also auf endlose Nachfragen gefasst: "Sag mal, wie war das mit der Schwerkraft nochmal?" oder "Isaac,
        hast du den Winkel schon berechnet?" Nur zu, tu so, als wäre es einfach, der Geniale mit dem Apfel zu sein.

        Und bedenke: Als Newton musst du stets den Kopf oben halten... besonders, wenn du unter Obstbäumen durchgehst.
        Der Apfel hat eine lange Tradition, und wenn du ihn nicht fängst, droht der Spott: "Newton, das war wohl nix mit
        der Gravitation!" Auch bei jeder Unebenheit am Wegesrand wirst du ab sofort misstrauisch beäugt. Denn es gibt
        für dich keine Ausreden mehr – fallen, stolpern oder ungeschickt den Kaffee verschütten, das darf jemand mit
        deinem Namen eigentlich gar nicht. Viel Spaß beim Experimentieren!
        TXT;

    }

    private static function einstein(): string
    {
        return <<<TXT
        Ah, Albert? So wie Albert Einstein? Mutig! Damit unterliegst du quasi der Erwartung, bei jedem zweiten Satz
        etwas zu sagen, das die Grenzen des Raum-Zeit-Kontinuums sprengt. Und wehe, du hast mal keine Antwort parat.
        Dann heißt es gleich: "Na, das war aber nicht gerade relativ genial, Herr Einstein!" Jeder Blick in die Runde
        könnte nun als „durchdringender Intellekt“ oder „nachdenkliches Genie“ fehlinterpretiert werden, selbst wenn du
        nur überlegst, ob du Pizza oder Pasta bestellen sollst.

        Aber hey, es gibt auch Vorteile! Endlich kannst du jede simple Entscheidung in komplexe Formeln verpacken:
        "Warum ich den Zug verpasst habe? Nun ja, wenn du die Relativität der Zeit verstehst, ist das eigentlich
        logisch." Und der Zirkus mit den Haaren? Keine Sorge, auch in deinem Fall darf es wild und ungekämmt sein
        Es ist jetzt offiziell "kreatives Chaos." Willkommen im Genie-Club, Herr Einstein, möge dein Alltag von
        Gleichungen und schrägen Fragen regiert sein!
        TXT;

    }

}