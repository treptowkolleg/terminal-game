<?php

namespace App\System;

use App\Dictionary\DictState;
use App\Dictionary\PrepDict;
use App\Dictionary\SubjectDict;
use App\Dictionary\VerbDict;
use Closure;

class HotKey
{

    private VerbDict $verb;
    private SceneObject|SubjectDict|null $a;
    private PrepDict|null $preposition;
    private SceneObject|SubjectDict|null $b;

    private Closure $callback;

    /**
     * @param VerbDict $verb
     * @param SceneObject|SubjectDict|null $a
     * @param PrepDict|null $preposition
     * @param SceneObject|SubjectDict|null $b
     * @param Closure|null $callback
     */
    public function __construct(VerbDict $verb, SceneObject|SubjectDict|null $a = null, PrepDict|null $preposition = null, SceneObject|SubjectDict|null $b = null, ?Closure $callback = null)
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

    public function getVerb(): VerbDict
    {
        return $this->verb;
    }

    public function checkVerb(string $input): DictState
    {
        if(!$verb = VerbDict::tryFrom(strtolower($input))) return DictState::UNKNOWN_VERB;
        if($verb != $this->verb) return DictState::WRONG_VERB;
        return DictState::PASS;
    }

    public function hasA(): bool
    {
        return (bool)$this->a;
    }

    public function checkA(string $input): DictState
    {
        if($this->a instanceof SubjectDict) {
            if(!$a = SubjectDict::tryFrom(strtolower($input))) return DictState::UNKNOWN_A;
            if($this->a !== $a) return DictState::WRONG_A;
        }
        if($this->a instanceof SceneObject) {
            if($this->a != strtolower($input)) return DictState::WRONG_A;
        }
        return DictState::PASS;
    }

    public function getA(): ?SceneObject
    {
        return $this->a;
    }

    public function getPreposition(): ?PrepDict
    {
        return $this->preposition;
    }

    public function checkPreposition(string $input): DictState
    {
        if(!$prep = PrepDict::tryFrom(strtolower($input))) return DictState::UNKNOWN_PREP;
        if($prep != $this->preposition) return DictState::WRONG_PREP;
        return DictState::PASS;
    }

    public function hasPreposition(): bool
    {
        return (bool)$this->preposition;
    }

    public function getB(): SceneObject|SubjectDict|null
    {
        return $this->b;
    }

    public function checkB(string $input): DictState
    {
        if($this->b instanceof SubjectDict) {
            if(!$b = SubjectDict::tryFrom(strtolower($input))) return DictState::UNKNOWN_B;
            if($this->b !== $b) return DictState::WRONG_B;
        }
        if($this->b instanceof SceneObject) {
            if($this->b != $b = strtolower($input)) return DictState::WRONG_B;
        }
        return DictState::PASS;
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

    public function checkPhrase(array $input): DictState
    {
        if (DictState::PASS != $return = $this->checkVerb($input[0])) return $return;
        if (count($input) == ($count = $this->getWordCount())) {
            if($count == 2) {
                if (DictState::PASS != $return = $this->checkB($input[1])) return $return;
            }
            if($count == 3) {
                if (DictState::PASS != $return = $this->checkPreposition($input[1])) return $return;
                if (DictState::PASS != $return = $this->checkB($input[2])) return $return;
            }
            if($count == 4) {
                if (DictState::PASS != $return = $this->checkA($input[1])) return $return;
                if (DictState::PASS != $return = $this->checkPreposition($input[2])) return $return;
                if (DictState::PASS != $return = $this->checkB($input[3])) return $return;
            }
            return DictState::PASS;
        }
        return DictState::MISSING_PARAMETER;
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public function runAction()
    {
        if($this->a instanceof SceneObject) call_user_func($this->a->getCallback(),self::getVerb());
        if($this->b instanceof SceneObject) call_user_func($this->b->getCallback(),self::getVerb());
        return call_user_func($this->getCallback());
    }

}