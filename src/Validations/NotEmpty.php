<?php

namespace alejoluc\Validation\Validations;

class NotEmpty extends BaseValidation {
    public function validate($data) {
        if (is_string($data)) {
            $data = trim($data);
            return $data !== '';
        } elseif (is_numeric($data)) {
            return true;
        } else {
            return !empty($data);
        }
    }
}