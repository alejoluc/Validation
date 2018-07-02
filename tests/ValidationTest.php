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
}