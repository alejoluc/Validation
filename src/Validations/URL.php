<?php

namespace alejoluc\Validation\Validations;

class URL extends BaseValidation {
    public function validate($data) {
        return filter_var($data, FILTER_VALIDATE_URL) !== false;
    }
}