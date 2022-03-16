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

        $this->assertSame($esperado, $atual, $renavam);
    }

    public function renavamProvider(): array
    {
        $correctValues = [32094074362, 23478829239, 34145742746, 41833820181, 639884962];
        $wrongValues = [11111111111, 32094074212, 62128843267];

        return array_reduce(
            array_merge($correctValues, $wrongValues),
            function ($acc, $value) use ($correctValues) {
                $key = "Renavam " . $value;
                $testProperties = ['renavam' => $value, 'esperado' => in_array($value, $correctValues)];

                $acc[$key] = $testProperties;
                return $acc;
            },
            []
        );
    }
}
