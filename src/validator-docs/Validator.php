<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs;

use Illuminate\Validation\Validator as BaseValidator;
use geekcom\ValidatorDocs\Rules\TituloEleitoral;
use geekcom\ValidatorDocs\Rules\Cns;
use geekcom\ValidatorDocs\Rules\Nis;
use geekcom\ValidatorDocs\Rules\Cpf;
use geekcom\ValidatorDocs\Rules\Cnpj;
use geekcom\ValidatorDocs\Rules\Cnh;
use geekcom\ValidatorDocs\Rules\Certidao;

use function preg_match;

/**
 *
 * @author Daniel Rodrigues Lima
 * @email danielrodrigues-ti@hotmail.com
 */
class Validator extends BaseValidator
{
    protected function validateFormatoCpf($attribute, $value): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }

    protected function validateFormatoCnpj($attribute, $value): bool
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }

    protected function validateFormatoCpfCnpj($attribute, $value): bool
    {
        return $this->validateFormatoCpf($attribute, $value) || $this->validateFormatoCnpj($attribute, $value);
    }

    protected function validateFormatoNis($attribute, $value): bool
    {
        return preg_match('/^\d{3}\.\d{5}\.\d{2}-\d{1}$/', $value) > 0;
    }

    protected function validateFormatoCertidao($attribute, $value): bool
    {
        return preg_match('/^\d{6}[. ]\d{2}[. ]\d{2}[. ]\d{4}[. ]\d{1}[. ]\d{5}[. ]\d{3}[. ]\d{7}[- ]\d{2}$/', $value) > 0;
    }

    protected function validateCpf($attribute, $value): bool
    {
        $cpf = new Cpf();

        return $cpf->validateCpf($attribute, $value);
    }

    protected function validateCnpj($attribute, $value): bool
    {
        $cnpj = new Cnpj();

        return $cnpj->validateCnpj($attribute, $value);
    }

    protected function validateCpfCnpj($attribute, $value): bool
    {
        $cpf = new Cpf();
        $cnpj = new Cnpj();

        return ($cpf->validateCpf($attribute, $value) || $cnpj->validateCnpj($attribute, $value));
    }

    protected function validateCnh($attribute, $value): bool
    {
        $cnh = new Cnh();

        return $cnh->validateCnh($attribute, $value);
    }

    protected function validateTituloEleitor($attribute, $value): bool
    {
        $tituloEleitoral = new TituloEleitoral();

        return $tituloEleitoral->validateTituloEleitor($attribute, $value);
    }

    protected function validateNis($attribute, $value): bool
    {
        $nis = new Nis();

        return $nis->validateNis($attribute, $value);
    }

    protected function validateCns($attribute, $value): bool
    {
        $cns = new Cns();

        return $cns->validateCns($attribute, $value);
    }

    protected function validateCertidao($attribute, $value): bool
    {
        $certidao = new Certidao();

        return $certidao->validateCertidao($attribute, $value);
    }
}
