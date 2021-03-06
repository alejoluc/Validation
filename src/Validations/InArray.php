<?php

namespace alejoluc\Validation\Validations;

class InArray extends BaseValidation {
    private $array = [];
    public function __construct($array) {
        $this->array = $array;
    }

    public function validate($data) {
        return in_array($data, $this->array, true) !== false;
    }
}