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

## Validators

```
Alpha                   Only letter characters
Alphanumeric            Only letters and numbers
AlphanumericUnderscore  Only letters, numbers and underscore
Email                   Valid E-mail address
URL                     Valid URL
Equals                  Strict comparison between two values
NotEquals               Strict comparison between two values
Between                 Numeric value between a minimum and a maximum
GreaterThan
LessThan
InArray
NotInArray
NotEmpty                A value is required
Regex
NotRegex
Numeric                 Checks whether a value is numeric (including strings containing numbers)
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
    'token' => 'adsjkgfuy43758vkj',
    'level' => 3
];
$rules = [
    'name'  => new Validations\NotEmpty,
    'mail'  => [new Validations\NotEmpty, new Validations\Email],
    'token' => new Validations\Regex('/^[a-z0-9]+$/'),
    'level' => [new Validations\Numeric, new Validations\Between(0, 5)]
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

## Changing the error messages language

Built in languages are English and Spanish. It defaults to English. To add languages, create a file in the `lang` folder.

Here's how to change in which language the errors will return. 

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use alejoluc\Validation\Validations;
use alejoluc\Validation\Validator;

$validator = new Validator;
$validator->setLanguage('es-es');

//....

```