<?php

// Parameter -p auslesen un der Variable $param zuweisen.
$val = getopt("p:");
if ($val !== false and isset($val["p"]))
{
    $param = strtolower($val["p"]);

    $result = match ($param) {
        "a" => "Antwort A",
        "apfel" => "Obst",
        "karotte" => "Gemüse",
        default => "Unbekanntes",
    };

    if($result) {
        echo "Es wurde $result gewählt." . PHP_EOL;
    } else {
        echo "Es wurde keine Variante gewählt (-p)" . PHP_EOL;
    }
}



$val = getopt("n:");
if ($val !== false and isset($val["n"]))
{
    // Zahl extrahieren (falls Buchstaben dabei sind).
    // Wird keine Zahl eingegeben, gilt: $number = 0;
    $number = intval($val["n"]);

    // Zahl mit Lebensabschnitt vergleichen
    $result = match (true) {
        $number >=  0 && $number <  7   => "Kleinkind",
        $number <  14                   => "Kind",
        $number <  21                   => "Jugendlicher",
        $number >= 21                   => "Erwachsener",
    };

    // Ergebnis präsentieren
    if($result) {
        echo "Du bist ein $result" . PHP_EOL;
    }
}



