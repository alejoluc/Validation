<?php

namespace alejoluc\Validation\Validations;

class Email extends BaseValidation {
    public function validate($data) {
        return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;
    }
}