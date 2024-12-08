<?php

namespace App\System;

use App\Dictionary\State;
use App\Dictionary\Preposition;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Scene;
use Closure;

class HotKey
{

    private Verb $verb;
    private SceneObject|Subject|string|null $a;
    private Preposition|null $preposition;
    private SceneObject|Subject|null $b;

    private Closure $callback;

    /**
     * @param Verb $verb
     * @param SceneObject|Subject|string|null $a
     * @param Preposition|null $preposition
     * @param SceneObject|Subject|null $b
     * @param Closure|null $callback
     */
    public function __construct(Verb $verb, SceneObject|Subject|string|null $a = null, Preposition|null $preposition = null, SceneObject|Subject|null $b = null, ?Closure $callback = null)
    {
        $this->verb = $verb;
        $this->a = $a;
        $this->preposition = $preposition;
        $this->b = $b;
        if($callback instanceof Closure){
            $this->callback = $callback;
        } else {
            $this->callback = function (){};
        }

    }

    public function __toString(): string
    {
        return strtolower("{$this->getVerb()?->value} {$this->getA()} {$this->getPreposition()?->value} {$this->getB()}");
    }

    public function getVerb(): Verb
    {
        return $this->verb;
    }

    public function checkVerb(string $input): State
    {
        if(!$verb = Verb::tryFrom(strtolower($input))) return State::UNKNOWN_VERB;
        if($verb != $this->verb) return State::WRONG_VERB;
        return State::PASS;
    }

    public function hasA(): bool
    {
        return (bool)$this->a;
    }

    public function checkA(string $input): State
    {
        if($this->a instanceof Subject) {
            if(!$a = Subject::tryFrom(strtolower($input))) return State::UNKNOWN_A;
            if($this->a !== $a) return State::FAIL;
        }
        if($this->a instanceof SceneObject) {
            if($this->a != strtolower($input)) return State::FAIL;
        }
        return State::PASS;
    }

    public function getA(): SceneObject|Subject|string|null
    {
        return $this->a;
    }

    public function getPreposition(): ?Preposition
    {
        return $this->preposition;
    }

    public function checkPreposition(string $input): State
    {
        if(!$prep = Preposition::tryFrom(strtolower($input))) return State::UNKNOWN_PREP;
        if($prep != $this->preposition) return State::WRONG_PREP;
        return State::PASS;
    }

    public function hasPreposition(): bool
    {
        return (bool)$this->preposition;
    }

    public function getB(): SceneObject|Subject|null
    {
        return $this->b;
    }

    public function checkB(string $input): State
    {
        if($this->b instanceof Subject) {
            if(!$b = Subject::tryFrom(strtolower($input))) return State::UNKNOWN_B;
            if($this->b !== $b) return State::WRONG_B;
        }
        if($this->b instanceof SceneObject) {
            if($this->b != strtolower($input)) return State::WRONG_B;
        }
        return State::PASS;
    }

    public function hasB(): bool
    {
        return (bool)$this->b;
    }

    public function getWordCount(): int
    {
        $i = 1;
        if(null != $this->a) $i++;
        if(null != $this->preposition) $i++;
        if(null != $this->b) $i++;
        return $i;
    }

    public function checkPhrase(array $input): State
    {
        if (State::PASS != $return = $this->checkVerb($input[0])) return $return;
        if (count($input) == ($count = $this->getWordCount())) {
            if($count == 2) {
                if (State::PASS != $return = $this->checkB($input[1])) return $return;
            }
            if($count == 3) {
                if (State::PASS != $return = $this->checkPreposition($input[1])) return $return;
                if (State::PASS != $return = $this->checkB($input[2])) return $return;
            }
            if($count == 4) {
                if (State::PASS != $return = $this->checkA($input[1])) return $return;
                if (State::PASS != $return = $this->checkPreposition($input[2])) return $return;
                if (State::PASS != $return = $this->checkB($input[3])) return $return;
            }
            return State::PASS;
        }
        return State::MISSING_PARAMETER;
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public function runAction(): mixed
    {
        $return = false;
        if($this->b instanceof SceneObject) $return = call_user_func($this->b->getCallback(),self::getVerb(), self::getA(), self::getPreposition());
        if($return instanceof Scene) return $return;
        return call_user_func($this->getCallback());
    }

}