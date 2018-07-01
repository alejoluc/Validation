<?php

namespace alejoluc\Validation\Validations;

/**
 * Class Alpha
 * Returns true if the data contains only letters
 * @package alejoluc\Validation\Validations
 */
class Alpha extends BaseValidation {
    public function validate($data) {
        return preg_match("/^[A-Za-z]*$/", $data) === 1;
    }
}