<?php

namespace alejoluc\Validation\Validations;

/**
 * Class NotEquals
 * Strict comparison between two values
 * @package alejoluc\Validation\Validations
 */
class NotEquals extends BaseValidation {
    private $compareWith;
    private $compareField = null;

    /**
     * NotEquals constructor.
     * If a single value is passed, it will be used in the error message
     * If an array is passed, the first element will be the field name used in the error message, and the
     * second element will be the compare value
     * @param mixed $compareWith
     */
    public function __construct($compareWith) {
        if (!is_array($compareWith)) {
            $this->compareWith = $compareWith;
        } else {
            $this->compareField = $compareWith[0];
            $this->compareWith  = $compareWith[1];
        }
    }
    public function validate($data) {
        return $data !== $this->compareWith;
    }
    public function getErrorMessage($lang, $ruleName) {
        if ($this->compareField === null) {
            return str_replace('{compareWith}', $this->compareWith, $lang[$ruleName]);
        } else {
            return str_replace('{compareWith}', $this->compareField, $lang[$ruleName]);
        }
    }
}