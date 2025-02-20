<?php

namespace App\System;

use App\GameEngine;

class Canvas
{

    public static array $rows = [];
    public static function clear(): void
    {
        for ($i = 0; $i < GameEngine::getHeight()-1; $i++) {
            self::$rows[$i] = array_fill(0,GameEngine::getWidth(),"░");
        }
    }

    public static function draw(string $string, int $xOffset = 0, int $yOffset = 0): void
    {
        $drawObject = explode(PHP_EOL, $string);
        $width = max(array_map('strlen', $drawObject));

        $height = count($drawObject);

        for ($i = 0; $i < count($drawObject); $i++) {
            for ($k = 0; $k < strlen($drawObject[$i]); $k++) {
                if($xOffset < 0) {
                    $x = GameEngine::getWidth() + 1 - $width + $k + $xOffset;
                } else {
                    $x = $k + $xOffset;
                }
                if($yOffset < 0) {
                    $y = GameEngine::getHeight() - 1 - $height + $i + $yOffset;
                } else {
                    $y = $i + $yOffset;
                }
                self::$rows[$y][$x] = $drawObject[$i][$k];
            }
        }

    }

    public static function render(): void
    {
        $output = "";
        foreach (self::$rows as $row) {
            $output .= implode("", $row);
        }
        Out::print($output . "░\n");
    }

}