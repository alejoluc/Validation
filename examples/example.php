<?php

require __DIR__ . '/../vendor/autoload.php';

use alejoluc\Validation\Validations;
use alejoluc\Validation\ValidatorFacade as Validator;

Validator::setLanguage('es-es');

$data = [
    'username'  => 'Alejo',
    'password'  => 'alejo123',
    'token'     => 'abcdefg',
    'email'     => 'alejolucangeli@gmail.com',
    'level'     => 3
];
$rules = [
    'username' => [new Validations\NotEmpty, new Validations\Alphanumeric],
    'password' => [new Validations\NotEmpty, new Validations\Alphanumeric, new Validations\NotEquals(['username', $data['username']])],
    'token'    => [new Validations\Alpha, new Validations\Regex('/^[a-z]*$/')],
    'email'    => new Validations\Email,
    'level'    => [new Validations\LessThan(5), new Validations\MoreThan(0), new Validations\Between(3,4)]
];

/* @var alejoluc\Validation\ValidationResult $result */
$result = Validator::validate($data, $rules);
if ($result->passes()) {
    echo "Everything is correct";
} else {
    echo "Error!\n";
    $errors = $result->getErrors();
    var_dump($errors);
}