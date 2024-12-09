<?php

namespace App\System;

use App\GameEngine;

class Inventar
{

    public static function collectable(string $class): bool
    {
        foreach (GameEngine::$availableItems as $item) {
            if (is_a($item, $class, true)) {
                return true;
            }
        }
        return false;
    }

    public static function has(string $class): bool
    {
        foreach (GameEngine::$inventar as $item) {
            if (is_a($item, $class, true)) {
                return true;
            }
        }
        return false;
    }

    public static function collect(string $class): void
    {
        foreach (GameEngine::$availableItems as $key => $item) {
            if (is_a($item, $class, true)) {
                GameEngine::$inventar[] = GameEngine::$availableItems[$key];
                unset(GameEngine::$availableItems[$key]);
                Out::itemAdded($item);
                break;
            }
        }
    }

    public static function use(string $class): void
    {
        foreach (GameEngine::$inventar as $key => $item) {
            if (is_a($item, $class, true)) {
                GameEngine::$usedItems[] = GameEngine::$inventar[$key];
                unset(GameEngine::$inventar[$key]);
                Out::itemUsed($item);
                break;
            }
        }
    }

    public static function used(string $class): bool
    {
        foreach (GameEngine::$usedItems as $item) {
            if (is_a($item, $class, true)) {
                return true;
            }
        }
        return false;
    }

}