<?php

namespace geekcom\ValidatorDocs\Tests\Formats;

use geekcom\ValidatorDocs\Formats\CpfCnpj;
use PHPUnit\Framework\TestCase;

class CpfCnpjTest extends TestCase
{
    public function testValidateFormat()
    {
        $instance = new CpfCnpj();

        self::assertTrue($instance->validateFormat('111.111.111-11'));
        self::assertTrue($instance->validateFormat('63.657.343/0001-43'));
        self::assertFalse($instance->validateFormat('11111111111'));
        self::assertFalse($instance->validateFormat('63.657.343/0001'));
    }
}
