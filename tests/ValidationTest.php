<?php

use PHPUnit\Framework\TestCase;
use alejoluc\Validation\Validator;
use alejoluc\Validation\Validations;

class ValidationTest extends TestCase {
    /* @var Validator $validator */
    private $validator = null;

    public function setUp() {
        $this->validator = new Validator();
    }

    public function testAlpha() {
        $data = [
            'user' => 'alejo',
            'pass' => 'ale3'
        ];
        $rules = [
            'user' => new Validations\Alpha,
            'pass' => new Validations\Alpha
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('pass', $result->getErrors());
        $this->assertArrayNotHasKey('user', $result->getErrors());
    }

    public function testAlphanumeric() {
        $data = [
            'user' => 'alejo1',
            'pass' => 'ale3_'
        ];
        $rules = [
            'user' => new Validations\Alphanumeric,
            'pass' => new Validations\Alphanumeric
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('pass', $result->getErrors());
        $this->assertArrayNotHasKey('user', $result->getErrors());
    }

    public function testAlphanumericUnderscore() {
        $data = [
            'user' => 'alejo_1',
            'pass' => 'ale_3-'
        ];
        $rules = [
            'user' => new Validations\AlphanumericUnderscore(),
            'pass' => new Validations\AlphanumericUnderscore()
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('pass', $result->getErrors());
        $this->assertArrayNotHasKey('user', $result->getErrors());
    }

    public function testBetween() {
        $data = [
            'age1'  => 20,
            'next1' => 21,
            'age2'  => 19,
            'next2' => 23
        ];
        $rules = [
            'age1'  => new Validations\Between(20, 22),
            'next1' => new Validations\Between(20, 22),
            'age2'  => new Validations\Between(20, 22),
            'next2' => new Validations\Between(20, 22)
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('next2', $result->getErrors());
        $this->assertArrayHasKey('age2', $result->getErrors());
        $this->assertArrayNotHasKey('age1', $result->getErrors());
        $this->assertArrayNotHasKey('next1', $result->getErrors());
    }

    public function testEmail() {
        $data = [
            'mail1' => 'alejolucangeli@gmail.com',
            'mail2' => 'alejolucangeligmail.com'
        ];
        $rules = [
            'mail1' => new Validations\Email,
            'mail2' => new Validations\Email
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('mail2', $result->getErrors());
        $this->assertArrayNotHasKey('mail1', $result->getErrors());
    }

    public function testEquals() {
        $data = [
            'name'   => 'Alejo Lucangeli',
            'age'    => 27,
            'height' => 170,
            'weight' => 71
        ];
        $rules = [
            'name'   => new Validations\Equals('Alejo Lucangeli'),
            'age'    => new Validations\Equals(27),
            'height' => new Validations\Equals(170),
            'weight' => new Validations\Equals(70)
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('weight', $result->getErrors());
        $this->assertArrayNotHasKey('name', $result->getErrors());
        $this->assertArrayNotHasKey('age', $result->getErrors());
        $this->assertArrayNotHasKey('height', $result->getErrors());
    }

    public function testGreaterThan() {
        $data = [
            '1' => 9,
            '2' => 10,
            '3' => 11
        ];
        $rules = [
            '1' => new Validations\GreaterThan(10),
            '2' => new Validations\GreaterThan(10),
            '3' => new Validations\GreaterThan(10)
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('1', $result->getErrors());
        $this->assertArrayHasKey('2', $result->getErrors());
        $this->assertArrayNotHasKey('3', $result->getErrors());
    }

    public function testLessThan() {
        $data = [
            '1' => 11,
            '2' => 10,
            '3' => 9
        ];
        $rules = [
            '1' => new Validations\LessThan(10),
            '2' => new Validations\LessThan(10),
            '3' => new Validations\LessThan(10)
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('1', $result->getErrors());
        $this->assertArrayHasKey('2', $result->getErrors());
        $this->assertArrayNotHasKey('3', $result->getErrors());
    }

    public function testNotEmpty() {
        $data = [
            'name'        => 'Alejo Lucangeli',
            'age'         => '0',
            'age_numeric' => 0,
            'email'       => '',
            'studies'     => []
        ];
        $rules = [
            'name'        => new Validations\NotEmpty,
            'age'         => new Validations\NotEmpty,
            'age_numeric' => new Validations\NotEmpty,
            'email'       => new Validations\NotEmpty,
            'studies'     => new Validations\NotEmpty
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('email', $result->getErrors());
        $this->assertArrayHasKey('studies', $result->getErrors());
        $this->assertArrayNotHasKey('name', $result->getErrors());
        $this->assertArrayNotHasKey('age', $result->getErrors());
        $this->assertArrayNotHasKey('age_numeric', $result->getErrors());
    }

    public function testNotEquals() {
        $data = [
            'name'        => 'Alejo Lucangeli',
            'age'         => '0',
            'age_numeric' => 0,
            'email'       => '',
            'studies'     => []
        ];
        $rules = [
            'name'        => new Validations\NotEquals('Alejo Lucangel'),
            'age'         => new Validations\NotEquals('0'),
            'age_numeric' => new Validations\NotEquals(0),
            'email'       => new Validations\NotEquals('alejolucangeli@gmail.com'),
            'studies'     => new Validations\NotEquals('')
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('age', $result->getErrors());
        $this->assertArrayHasKey('age_numeric', $result->getErrors());
        $this->assertArrayNotHasKey('email', $result->getErrors());
        $this->assertArrayNotHasKey('studies', $result->getErrors());
    }

    public function testRegex() {
        $data = [
            'user'  => 'alejo123',
            'pass'  => 'a1234567',
            'level' => 123
        ];
        $rules = [
            'user'  => new Validations\Regex('/^[A-Za-z0-9]*$/'),
            'pass'  => new Validations\Regex('/^[A-Za-z0-9]*$/'),
            'level' => new Validations\Regex('/^[A-Za-z]*$/')
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayNotHasKey('user', $result->getErrors());
        $this->assertArrayNotHasKey('pass', $result->getErrors());
        $this->assertArrayHasKey('level', $result->getErrors());
    }

    public function testNotRegex() {
        $data = [
            'user'  => 'alejo123',
            'pass'  => 'a1234567',
            'level' => 123
        ];
        $rules = [
            'user'  => new Validations\NotRegex('/^[A-Za-z0-9]*$/'),
            'pass'  => new Validations\NotRegex('/^[A-Za-z0-9]*$/'),
            'level' => new Validations\NotRegex('/^[A-Za-z]*$/')
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('user', $result->getErrors());
        $this->assertArrayHasKey('pass', $result->getErrors());
        $this->assertArrayNotHasKey('level', $result->getErrors());
    }

    public function testNumeric() {
        $data = [
            'user'  => 'alejo',
            'pass'  => '12345',
            'level' => 4
        ];
        $rules = [
            'user'  => new Validations\Numeric,
            'pass'  => new Validations\Numeric,
            'level' => new Validations\Numeric
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('user', $result->getErrors());
        $this->assertArrayNotHasKey('pass', $result->getErrors());
        $this->assertArrayNotHasKey('level', $result->getErrors());
    }

    public function testURL() {
        $data = [
            'url1' => 'http://alejolucangeli.com',
            'url2' => 'http:alejolucangeli.com'
        ];
        $rules = [
            'url1' => new Validations\URL,
            'url2' => new Validations\URL
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('url2', $result->getErrors());
        $this->assertArrayNotHasKey('url1', $result->getErrors());
    }

    public function testInArray() {
        $data = [
            'extension1' => 'rar',
            'extension2' => 'bin',
            'extension3' => 'jpeg'
        ];
        $rules = [
            'extension1' => new Validations\InArray(['zip', 'rar', 'gz']),
            'extension2' => new Validations\InArray(['exe', 'bin']),
            'extension3' => new Validations\InArray(['gif', 'bmp']),
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('extension3', $result->getErrors());
        $this->assertArrayNotHasKey('extension1', $result->getErrors());
        $this->assertArrayNotHasKey('extension2', $result->getErrors());
    }

    public function testNotInArray() {
        $data = [
            'extension1' => 'rar',
            'extension2' => 'bin',
            'extension3' => 'jpeg'
        ];
        $rules = [
            'extension1' => new Validations\NotInArray(['zip', 'rar', 'gz']),
            'extension2' => new Validations\NotInArray(['exe', 'bin']),
            'extension3' => new Validations\NotInArray(['gif', 'bmp']),
        ];
        $result = $this->validator->validate($data, $rules);
        $this->assertFalse($result->passes());
        $this->assertArrayHasKey('extension1', $result->getErrors());
        $this->assertArrayHasKey('extension2', $result->getErrors());
        $this->assertArrayNotHasKey('extension3', $result->getErrors());
    }
}