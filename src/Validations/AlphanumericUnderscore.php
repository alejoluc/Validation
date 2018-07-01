<?php

namespace alejoluc\Validation\Validations;

/**
 * Class AlphanumericUnderscore
 * Similar to alejoluc\Validation\Alphanumeric, but also accepts underscores
 * @package alejoluc\Validation\Validations
 */
class AlphanumericUnderscore extends BaseValidation {
    public function validate($data) {
        return preg_match("/^\w*$/", $data) === 1;
    }
}