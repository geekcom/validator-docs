<?php

namespace geekcom\ValidatorDocs\Tests\Formats;

use geekcom\ValidatorDocs\Formats\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    private Cpf $cpf;

    protected function setUp(): void
    {
        $this->cpf = new Cpf();
    }

    public function testIsFormatValidationWorksWell(): void
    {
        self::assertTrue($this->cpf->validateFormat('111.111.111-11'));
        self::assertFalse($this->cpf->validateFormat('11111111111'));
    }
}
