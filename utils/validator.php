<?php

class Validator {
    public function __construct(
        private $field
    ) {}

    public function get() {
        return $this->field;
    }

    public function string(): Validator {
        $this->field = (string) $this->field;
        return $this;
    }

    public function int(): Validator {
        $this->field = (int) $this->field;
        return $this;
    }

    public function float(): Validator {
        $this->field = (float) $this->field;
        return $this;
    }

    public function min(int $min): Validator {
        if(strlen($this->field) < $min) {
            throw new Error('Field is less than min. Field size: '.strlen($this->field).', Min: '. $min);
        }

        return $this;
    }

    public function max(int $max): Validator {
        if(strlen($this->field) > $max) {
            throw new Error('Field is greater than max. Field size: '.strlen($this->field).', Max: '. $max);
        }

        return $this;
    }

    public function email(): Validator {
        if(!preg_match("/^([A-Za-z0-9]+)@([A-Za-z0-9]+).([A-Za-z0-9]+)$/", $this->field)) {
            throw new Error("Email isn't valid");
        }

        return $this;
    }

    public function prefix(string $prefix): Validator {
        if(!preg_match("/^{$prefix}/", $this->field)) {
            throw new Error("Prefix isn't valid");
        }

        return $this;
    }

    public function suffix(string $suffix): Validator {
        if(!preg_match("/{$suffix}$/", $this->field)) {
            throw new Error("Suffix isn't valid");
        }

        return $this;
    }
}