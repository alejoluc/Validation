<?php

namespace alejoluc\Validation\Validations;

class NotEmpty extends BaseValidation {
    public function validate($data) {
        if (is_string($data)) {
            $data = trim($data);
            return $data !== '';
        } else {
            return !empty($data);
        }
    }
}