<?php

namespace alejoluc\Validation;

class ValidatorFacade {
    protected static $instance = null;

    public static function getInstance() {
        return static::$instance;
    }

    public static function setInstance(Validator $instance) {
        static::$instance = $instance;
    }

    public static function __callStatic($methodName, $arguments) {
        if (static::getInstance() === null) {
            static::setInstance(new Validator);
        }
        return call_user_func_array([static::getInstance(), $methodName], $arguments);
    }

}