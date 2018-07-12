<?php

require __DIR__ . '/../vendor/autoload.php';

use alejoluc\Validation\Validations;
use alejoluc\Validation\Validator;

$validator = new Validator;

$data = [
    'name'  => 'Alejo Lucangeli',
    'mail'  => 'alejolucangeli@gmail.com',
    'token' => 'adsjkgfuy43758vkj',
    'age'   => 27
];
$rules = [
    'name'  => new Validations\NotEmpty,
    'mail'  => [new Validations\NotEmpty, new Validations\Email],
    'token' => new Validations\Regex('/^[a-z0-9]+$/'),
    'age'   => new Validations\Numeric,
    'noexistent' => new Validations\NotEmpty
];

$result = $validator->validate($data, $rules);
if ($result->passes()) {
    echo "All fine";
} else {
    //Display all error messages
    $errors = $result->getErrorMessages();
    foreach ($errors as $error) {
        echo "- $error\n";
    }

    //Display errors by field
    $errors = $result->getErrors();
    foreach ($errors as $field => $errorMessages) {
        echo "Errors in field $field:\n";
        foreach ($errorMessages as $message) {
            echo "  - $message\n";
        }
    }
}