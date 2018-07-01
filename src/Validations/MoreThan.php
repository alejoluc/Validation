<?php

namespace alejoluc\Validation\Validations;

class MoreThan extends BaseValidation {
    private $min;
    private $forceInt = false;
    public function __construct($min, $forceInteger = false) {
        if ($forceInteger) {
            $this->forceInt = true;
            $this->min = (int)$min;
        } else {
            $this->min = $min;
        }
    }

    public function validate($data) {
        if ($this->forceInt) {
            return (int)$data > $this->min;
        }
        return $data > $this->min;
    }

    public function getErrorMessage($lang, $ruleName) {
        return str_replace('{min}', $this->min, $lang[$ruleName]);
    }
}