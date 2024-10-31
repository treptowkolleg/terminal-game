<?php

namespace App\System;

use App\Dictionary\PrepDict;
use App\Dictionary\SubjectDict;
use App\Dictionary\VerbDict;
use Closure;

class HotKeySet
{

    private array $keys = [];
    private SceneObject|SubjectDict|null $b;

    public function __construct(SceneObject|SubjectDict|null $b = null)
    {
        $this->b = $b;
    }

    public function addKey(VerbDict $verb, SceneObject|SubjectDict|null $a = null, PrepDict|null $preposition = null, ?Closure $callback = null): self
    {
        $this->keys[] = new HotKey($verb, $a, $preposition, $this->b, $callback);
        return $this;
    }

    public function getKeys(): array
    {
        return $this->keys;
    }

}