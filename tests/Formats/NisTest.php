<?php

namespace geekcom\ValidatorDocs\Tests\Formats;

use geekcom\ValidatorDocs\Formats\Nis;
use PHPUnit\Framework\TestCase;

class NisTest extends TestCase
{
    public function testValidateFormat()
    {
        $nis = new Nis();

        self::assertTrue($nis->validateFormat('201.73374.34-9'));
    }
}
