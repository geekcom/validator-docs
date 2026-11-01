<?php

namespace geekcom\ValidatorDocs\Tests\Rules;

use geekcom\ValidatorDocs\Rules\Certidao;
use geekcom\ValidatorDocs\Tests\ValidatorTestCase;

final class CertidaoTest extends ValidatorTestCase
{
    /**
     * @test
     *
     * @dataProvider certidaoProvider
     */
    public function certidaoValida($certidao, $esperado): void
    {
        $instance = new Certidao();

        $atual = $instance->validateCertidao('', $certidao);

        $this->assertSame($esperado, $atual, (string) $certidao);
    }

    public function certidaoProvider(): array
    {
        return [
            // 32 digits: valid
            'certidao valida' => ['65944702559015199679468255959016', true],
            // 33 digits: same number plus a trailing digit must not be accepted
            'certidao com digito extra' => ['123456789012345678901234567890134', false],
            'certidao com digito extra no fim de uma valida' => ['6594470255901519967946825595901699', false],
        ];
    }
}
