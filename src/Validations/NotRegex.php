<?php

namespace alejoluc\Validation\Validations;

class NotRegex extends BaseValidation {
    private $regex;

    public function __construct($regex) {
        $this->regex = $regex;
    }

    public function validate($data) {
        return preg_match($this->regex, $data) !== 1;
    }
}