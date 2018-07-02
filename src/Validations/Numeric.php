<?php

namespace alejoluc\Validation\Validations;

/**
 * Class Numeric
 * Returns true if the data is numeric
 * @package alejoluc\Validation\Validations
 */
class Numeric extends BaseValidation {
    public function validate($data) {
        return is_numeric($data);
    }
}