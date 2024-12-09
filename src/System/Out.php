<?php

namespace App\System;

use App\GameEngine;

class Out
{

    public static function talk(string $character, string $message): void
    {
        self::print("░▒ $character: ", TextColor::lightBlue);
        self::print(">>", TextColor::lightBlue);
        self::print("$message");
        self::printLn("<<", TextColor::lightBlue);
    }

    public static function info(string $message): void
    {
        self::print("░▒ ");
        self::printLn("$message");
    }

    public static function itemAdded(SceneObject $item): void
    {
        self::print("░▒ ", TextColor::cyan);
        $label = ucfirst($item->getLabel());
        self::printLn("{$label} erhalten", TextColor::cyan);
    }

    public static function itemUsed(SceneObject $item): void
    {
        self::print("░▒ ", TextColor::purple);
        $label = ucfirst($item->getLabel());
        self::printLn("{$label} verwendet", TextColor::purple);
    }

    /**
     * Gibt Text MIT Zeilenumbruch aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist none)
     */
    public static function printLn(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): void
    {
        echo sprintf("%s%s%s%s\n",self::setColor($color),self::setColor($background),$text,self::setColor('0'));
    }

    public static function printListLn(string $titel, string $text, int $width = 32, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): void
    {
        $dotLength = $width - ( strlen($titel) + strlen($text) );
        $dots = '';
        for($i = 1; $i <= $dotLength; $i++) $dots .= '.';
        echo sprintf("%s%s%s%s%s%s\n",self::setColor($color), self::setColor($background),$titel, $dots, $text, self::setColor('0'));
    }

    public static function printOptionLn(string $titel, string $text, int $width = 16, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): void
    {
        $dotLength = $width - strlen($titel);
        $textColor = TextColor::white;
        $dots = '';
        for($i = 1; $i <= $dotLength; $i++) $dots .= ' ';
        echo sprintf("%s%s%s%s:%s%s%s\n",self::setColor($color), self::setColor($background),$titel,self::setColor($textColor), $dots, $text, self::setColor('0'));
    }


    /**
     * Gibt Text OHNE Zeilenumbruch aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     */
    public static function print(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): void
    {
        echo sprintf("%s%s%s%s",self::setColor($color),self::setColor($background),$text,self::setColor('0'));
    }

    public static function string(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): string
    {
        return sprintf("%s%s%s%s",self::setColor($color),self::setColor($background),$text,self::setColor('0'));
    }

    /**
     * Gibt Alarm-Block MIT Zeilenumbruch aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist rot)
     * @param int $whitespace Leerzeichen zwischen Rand und Text
     */
    public static function printAlert(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::red, int $whitespace = 6): void
    {
        self::generateFrame($text, ' ',  $whitespace, $color,$background);
    }

    /**
     * Gibt Text als Überschrift MIT Zeilenumbruch und Leerzeile aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     * @param int $whitespace Leerzeichen zwischen Rand und Text
     */
    public static function printHeading(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none, int $whitespace = 6): void
    {
        self::generateFrame($text, whitespace: $whitespace, color: $color, background: $background);
    }

    /**
     * @param string $text Text, der ausgegeben werden soll.
     * @param string $frameChar Zeichen, das für den Rahmen verwendet werden soll.
     * @param int $whitespace Leerzeichen zwischen Rand und Text
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     */
    private static function generateFrame(string $text, string $frameChar = "#", int $whitespace = 1, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::none): void
    {
        $horizontalLine = '';
        $whiteSpaceLine = '';
        for($i = 1; $i <= (strlen($text) + (2*$whitespace)+2); $i++) $horizontalLine .= $frameChar;
        for($i = 1; $i <= $whitespace; $i++) $whiteSpaceLine .= ' ';

        self::printLn($horizontalLine, $color, $background);
        self::printLn($frameChar.$whiteSpaceLine.$text.$whiteSpaceLine.$frameChar, $color, $background);
        self::printLn($horizontalLine, $color, $background);
        self::printLn("");
    }

    /**
     * Hilfsmethode, um Farben zu codieren.
     * @param string|TextColor|BackgroundColor $color Farbcode
     * @return string codierter Farbcode
     */
    public static function setColor(string|TextColor|BackgroundColor $color): string
    {
        if($color instanceof TextColor || $color instanceof BackgroundColor) {
            return "\033[{$color->value}m";
        } else {
            return "\033[{$color}m";
        }
    }

    public static function blink(string $text): string
    {
        return "\033[5m$text\033[0m";
    }

    public static function clearView(): void
    {
        echo "\033[2J\033[1;1H";
    }


}