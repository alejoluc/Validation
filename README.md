# Validation

## Installation

From the command line:

`composer require alejoluc/validation`

Or write manually in `composer.json`:

```json
{
  "require": {
    "alejoluc/validation": "*"
  }
}
```

## Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use alejoluc\Validation\Validations;
use alejoluc\Validation\Validator;

$validator = new Validator;

$data = [
    'name'  => 'Alejo Lucangeli',
    'mail'  => 'alejolucangeli@gmail.com',
    'token' => 'adsjkgfuy43758vkj'
];
$rules = [
    'name'  => new Validations\NotEmpty,
    'mail'  => [new Validations\NotEmpty, new Validations\Email],
    'token' => new Validations\Regex('/^[a-z0-9]+$/')
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
```

## Using the Facade

Those familiar with Laravel will be used to calling Facades to access instances of an object. This is possible with Validation.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use alejoluc\Validation\Validations;
use alejoluc\Validation\ValidatorFacade as Validator;

//[... setup data and rules ]

/* @var alejoluc\Validation\ValidationResult $result */
$result = Validator::validate($data, $rules);
if ($result->passes()) {
    echo "All fine";
} else {
    $errors = $result->getErrorMessages();
    foreach ($errors as $error) {
        echo "- $error\n";
    }
}
```