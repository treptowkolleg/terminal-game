<?php

namespace App\System;

use App\Dictionary\Preposition;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use Closure;

class HotKeySet
{

    private array $keys = [];
    private SceneObject|Subject|null $b;

    public function __construct(SceneObject|Subject|null $b = null)
    {
        $this->b = $b;
    }

    public function addKey(Verb $verb, SceneObject|Subject|string|null $a = null, Preposition|null $preposition = null, ?Closure $callback = null): self
    {
        $this->keys[] = new HotKey($verb, $a, $preposition, $this->b, $callback);
        return $this;
    }

    public function getKeys(): array
    {
        return $this->keys;
    }

}