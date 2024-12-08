<?php

namespace App\System;

use App\GameEngine;

class Inventar
{

    public static function collectable(string $class): bool
    {
        foreach (GameEngine::$availableItems as $item) {
            if ($item instanceof $class) {
                return true;
            }
        }
        return false;
    }

    public static function has(string $class): bool
    {
        foreach (GameEngine::$inventar as $item) {
            if ($item instanceof $class) {
                return true;
            }
        }
        return false;
    }

    public static function collect(string $class): void
    {
        foreach (GameEngine::$availableItems as $key => $item) {
            if ($item instanceof $class) {
                GameEngine::$inventar[] = GameEngine::$availableItems[$key];
                unset(GameEngine::$availableItems[$key]);
                break;
            }
        }
    }

    public static function use(string $class): void
    {
        foreach (GameEngine::$inventar as $key => $item) {
            if ($item instanceof $class) {
                GameEngine::$usedItems[] = GameEngine::$inventar[$key];
                unset(GameEngine::$inventar[$key]);
                break;
            }
        }
    }

    public static function used(string $class): bool
    {
        foreach (GameEngine::$usedItems as $item) {
            if ($item instanceof $class) {
                return true;
            }
        }
        return false;
    }

}