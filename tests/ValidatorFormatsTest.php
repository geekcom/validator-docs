<?php

namespace geekcom\ValidatorDocs\Tests;

use geekcom\ValidatorDocs\ValidatorFormats;
use Illuminate\Support\Facades\Validator;
use Exception;

final class ValidatorFormatsTest extends ValidatorTestCase
{
    public ValidatorFormats $validatorFormats;

    public function setUp(): void
    {
        $this->validatorFormats = new ValidatorFormats();
    }

    /** @test */
    public function lancaExcecaoQuandoValorNaoExiste(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Value not informed.');

        $this->validatorFormats->execute('', 'cpf');
    }

    /** @test */
    public function lancaExcecaoQuandoDocumentoNaoSuportado(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Don\'t exists validator for this document.');

        $this->validatorFormats->execute('053.222.333-74', 'foo');
    }

    /** @test */
    public function formatoCpf(): void
    {
        self::assertTrue($this->validatorFormats->execute('000.000.000-00', 'cpf'));
        self::assertFalse($this->validatorFormats->execute('00000000000', 'cpf'));
    }

    /** @test */
    public function formatoCnpj(): void
    {
        self::assertTrue($this->validatorFormats->execute('00.000.000/0000-00', 'cnpj'));
        self::assertFalse($this->validatorFormats->execute('00000000000000', 'cnpj'));
    }

    /** @test */
    public function formatoCertidao(): void
    {
        self::assertTrue($this->validatorFormats->execute('434546.02.55.2019.1.71037.134.6484858-10', 'certidao'));
        self::assertFalse($this->validatorFormats->execute('434546.02.55.2019.1.71037.134.6484858', 'certidao'));
    }

    /** @test */
    public function formatoNis(): void
    {
        self::assertTrue($this->validatorFormats->execute('201.73374.34-9', 'nis'));
    }

    /** @test */
    public function formatocpfECnpjNoMesmoAtributo(): void
    {
        self::assertTrue($this->validatorFormats->execute('111.111.111-11', 'cpfCnpj'));
        self::assertTrue($this->validatorFormats->execute('63.657.343/0001-43', 'CpfCnpj'));
        self::assertFalse($this->validatorFormats->execute('11111111111', 'CpfCnpj'));
        self::assertFalse($this->validatorFormats->execute('63.657.343/0001', 'CpfCnpj'));
    }

    /** @test */
    public function formatoRenavam()
    {
        $correct = Validator::make(
            ['certo' => '197073212'],
            ['certo' => 'renavam']
        );

        $incorrect = Validator::make(
            ['errado' => '1234555582'],
            ['errado' => 'renavam']
        );

        $this->assertTrue($correct->passes());
        $this->assertTrue($incorrect->fails());

        $correct = Validator::make(
            ['certo' => '1970.73212'],
            ['certo' => 'renavam']
        );

        $this->assertTrue($correct->passes());
    }
}
