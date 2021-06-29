<?php

namespace geekcom\ValidatorDocs\Tests;

use geekcom\ValidatorDocs\ValidatorFormats;
use Exception;

class ValidatorFormatsTest extends ValidatorTestCase
{
    public function testIsValidatorReturningExceptionWhenValueNotExists(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Value not informed.');

        $validatorFormats = new ValidatorFormats();
        $validatorFormats->execute('', 'cpf');
    }

    public function testIsValidatorReturningExceptionWhenDocumentIsNotSupported(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Don\'t exists validator for this document.');

        $validatorFormats = new ValidatorFormats();
        $validatorFormats->execute('053.222.333-74', 'foo');
    }

    public function testIsValidatorExecutingValidatorFormats(): void
    {
        $validatorFormats = new ValidatorFormats();

        self::assertTrue($validatorFormats->execute('053.222.333-74', 'cpf'));
    }
}
