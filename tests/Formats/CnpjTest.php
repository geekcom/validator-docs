<?php

namespace geekcom\ValidatorDocs\Tests\Formats;

use geekcom\ValidatorDocs\Formats\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    public function testValidateFormat()
    {
        $cnpjFormat = new Cnpj();

        self::assertTrue($cnpjFormat->validateFormat('63.657.343/0001-43'));
        self::assertFalse($cnpjFormat->validateFormat('63.657.343/0001'));
    }
}
