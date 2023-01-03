<?php

namespace geekcom\ValidatorDocs\Tests;

use geekcom\ValidatorDocs\Rules\Sanitization;

final class SanitizationTestCase extends ValidatorTestCase
{
    /** @test **/
    public function sanitizeRetornaVazioQuandoNuloOuVazio()
    {
        $mock = $this->getMockForAbstractClass(Sanitization::class);
        $this->assertEquals("", $mock->sanitize(null));
    }

    /** @test **/
    public function sanitizeRetornaSomenteDigitos()
    {
        $mock = $this->getMockForAbstractClass(Sanitization::class);
        $this->assertEquals("53084587000120", $mock->sanitize('a53.084.587/0001-20z'));
    }
}
