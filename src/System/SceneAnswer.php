<?php

namespace App\System;

use Closure;

class SceneAnswer
{

    private string $label;
    private string $key;

    /**
     * @var Closure $callback muss Case aus der Enum App\Story\Scene zurückgeben.
     */
    private Closure $callback;

    public function __construct(string $label, string $key, Closure $callback)
    {
        $this->label = $label;
        $this->key = $key;
        $this->callback = $callback;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public static function make(string $label, string $key, Closure $callback): SceneAnswer
    {
        return new self($label, $key, $callback);
    }

}