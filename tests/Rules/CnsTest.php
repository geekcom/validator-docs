<?php

namespace geekcom\ValidatorDocs\Tests\Rules;

use geekcom\ValidatorDocs\Rules\Cns;
use geekcom\ValidatorDocs\Tests\ValidatorTestCase;

final class CnsTest extends ValidatorTestCase
{
    /**
     * @test
     *
     * @dataProvider cnsProvider
     */
    public function cnsValido($cns, $esperado): void
    {
        $instance = new Cns();

        $atual = $instance->validateCns('', $cns);

        $this->assertSame($esperado, $atual, (string) $cns);
    }

    public function cnsProvider(): array
    {
        return [
            'cns definitivo valido' => ['116 3876 9194 0009', true],
            'cns provisorio valido' => ['892 1623 5477 0008', true],
            'cns definitivo com digito extra' => ['116 3876 9194 00099', false],
            'cns provisorio com digito extra' => ['892 1623 5477 00089', false],
        ];
    }
}
