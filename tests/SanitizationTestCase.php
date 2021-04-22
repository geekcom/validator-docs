<?php

namespace geekcom\ValidatorDocs\Tests;

use geekcom\ValidatorDocs\Rules\Sanitization;
use Illuminate\Support\Facades\Validator;

final class SanitizationTestCase extends ValidatorTestCase
{
    /** @test **/
    public function sanitizeRetornaVazioQuandoNuloOuVazio()
    {
        $mock = $this->getMockForAbstractClass(Sanitization::class);
        $this->assertEquals($mock->sanitize(null), "");
    }

    /** @test **/
    public function sanitizeRetornaSomenteDigitos()
    {
        $mock = $this->getMockForAbstractClass(Sanitization::class);
        $this->assertEquals($mock->sanitize('a53.084.587/0001-20z'), "53084587000120");
    }
}
