<?php

namespace App\System;

use Closure;

class SceneObject
{

    private string $label;
    private string $description;
    private array $hotKey;
    private Closure $callback;

    public function __construct(string $label, string $description, Closure $callback)
    {
        $this->label = $label;
        $this->description = $description;
        $this->callback = $callback;
    }

    public function __toString(): string
    {

        return $this->getLabel();
    }

    public function getLabel(): string
    {
        return strtolower($this->label);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public static function make(string $label, string $description, Closure $callback): SceneObject
    {
        return new self($label, $description, $callback);
    }

}