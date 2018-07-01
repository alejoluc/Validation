<?php

namespace alejoluc\Validation\Validations;

class BaseValidation {
    public function getErrorMessage($lang, $ruleName) {
        return $lang[$ruleName];
    }
}