<?php

namespace geekcom\ValidatorDocs\Tests\Rules;

use geekcom\ValidatorDocs\Rules\Renavam;
use geekcom\ValidatorDocs\Tests\ValidatorTestCase;

final class RenavamTest extends ValidatorTestCase
{
    /**
     * @test
     *
     * @dataProvider renavamProvider
     */
    public function renavamValido($renavam, $esperado): void
    {
        $instance = new Renavam();

        $atual = $instance->validateRenavam('', $renavam);

        $this->assertSame($esperado, $atual);
    }

    public function renavamProvider(): array
    {
        return [
            'Input correto' => [
                'renavam' => 639884962,
                'esperado' => true,
            ],
            'Input incorreto' => [
                'renavam' => 11111111111,
                'esperado' => false
            ],
        ];
    }
}
