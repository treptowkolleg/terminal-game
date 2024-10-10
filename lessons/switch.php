<?php

// Parameter -p auslesen un der Variable $param zuweisen.
$val = getopt("p:");
$param = false;
if ($val !== false and isset($val["p"])) {
    $param = strtolower($val["p"]);
}

// Hilfsvariablen deklarieren
$result = null;
$effect = false;

switch ($param) {
    case "a":
        $result = "Antwort A";
        $effect = true;
        break;
    case "apfel":
        $result = "Obst";
        break;
    case "karotte":
        $result = "Gemüse";
        $effect = true;
        break;
    default:
        $result = "Unbekanntes";
}

// Variablen entsprechend switch-Ergebnis ausgeben:
if($effect) {
    echo "Spezialeffekt aktiviert!" . PHP_EOL;
}

if($param) {
    echo "Es wurde $result gewählt." . PHP_EOL;
} else {
    echo "Es wurde keine Variante gewählt (-p)" . PHP_EOL;
}

