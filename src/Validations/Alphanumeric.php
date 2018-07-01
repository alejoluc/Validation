<?php

namespace alejoluc\Validation\Validations;

/**
 * Class Alphanumeric
 * Returns true if the data contains only letters and numbers, no other characters including
 * dashes and underscores
 * @package alejoluc\Validation\Validations
 */
class Alphanumeric extends BaseValidation {
    public function validate($data) {
        return preg_match("/^[A-Za-z0-9]*$/", $data) === 1;
    }
}