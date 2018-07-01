<?php

namespace alejoluc\Validation;

class ValidationResult {
    private $errors = [];

    public function addError($field, $message) {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = str_replace('{field}', $field, $message);
    }

    /**
     *  Returns the array of errors, indexed by the field name
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Returns an array containing all the error messages, not indexed by field name
     * @return array
     */
    public function getErrorMessages() {
        $messages = [];
        foreach ($this->errors as $field => $errors) {
            $messages = array_merge($messages, $errors);
        }
        return $messages;
    }

    /**
     * Returns true if there are no errors
     * @return bool
     */
    public function passes() {
        return count($this->errors) === 0;
    }

    /**
     * Returns true if there is at least one error
     * @return bool
     */
    public function fails() {
        return !$this->passes();
    }
}