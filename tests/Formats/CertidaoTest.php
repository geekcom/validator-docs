<?php

namespace geekcom\ValidatorDocs\Tests\Formats;

use geekcom\ValidatorDocs\Formats\Certidao;
use PHPUnit\Framework\TestCase;

class CertidaoTest extends TestCase
{
    public function testValidateFormat()
    {
        $certidao = new Certidao();

        self::assertTrue($certidao->validateFormat('434546.02.55.2019.1.71037.134.6484858-10'));
        self::assertFalse($certidao->validateFormat('434546.02.55.2019.1.71037.134.6484858'));
    }
}
