<?php

namespace alejoluc\Validation\Validations;

class Regex extends BaseValidation {
    private $regex;

    public function __construct($regex) {
        $this->regex = $regex;
    }

    public function validate($data) {
        return preg_match($this->regex, $data) === 1;
    }
}