<?php

namespace alejoluc\Validation\Validations;

class Between extends BaseValidation {
    private $min;
    private $max;
    private $forceInt;

    public function __construct($min, $max, $forceInteger = false) {
        if ($forceInteger) {
            $this->min = (int)$min;
            $this->max = (int)$max;
        } else {
            $this->min = $min;
            $this->max = $max;
        }
    }

    public function validate($data) {
        if ($this->forceInt) {
            $data = (int)$data;
        }
        return $data >= $this->min && $data <= $this->max;
    }

    public function getErrorMessage($lang, $ruleName) {
        $str = str_replace('{min}', $this->min, $lang[$ruleName]);
        $str = str_replace('{max}', $this->max, $str);
        return $str;
    }
}