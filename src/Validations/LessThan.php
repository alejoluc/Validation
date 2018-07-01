<?php

namespace alejoluc\Validation\Validations;

class LessThan extends BaseValidation {
    private $max;
    private $forceInt = false;
    public function __construct($max, $forceInteger = false) {
        if ($forceInteger) {
            $this->forceInt = true;
            $this->max = (int)$max;
        } else {
            $this->max = $max;
        }
    }

    public function validate($data) {
        if ($this->forceInt) {
            return (int)$data < $this->max;
        }
        return $data < $this->max;
    }

    public function getErrorMessage($lang, $ruleName) {
        return str_replace('{max}', $this->max, $lang[$ruleName]);
    }
}