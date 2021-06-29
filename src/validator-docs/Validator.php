<?php

namespace geekcom\ValidatorDocs;

use geekcom\ValidatorDocs\Rules\{Certidao,
    Cnh,
    Cnpj,
    Cns,
    Cpf,
    Ddd,
    InscricaoEstadual,
    Nis,
    Placa,
    Renavam,
    TituloEleitoral};
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Validator as BaseValidator;

class Validator extends BaseValidator
{
    public function __construct(
        Translator $translator,
        ValidatorFormats $formatValidator,
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
    }

    protected function validateFormat($value, $document, $attribute = null)
    {
        if (!empty($value)) {
            return (new ValidatorFormats())->execute($value, $document);
        }
    }

    protected function validateCpf($attribute, $value): bool
    {
        $cpf = new Cpf();

        $this->validateFormat($value, 'cpf');

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

    protected function validateInscricaoEstadual($attribute, $value, $parameters): bool
    {
        $inscricaoEstadual = new InscricaoEstadual();

        return $inscricaoEstadual->validateInscricaoEstadual($attribute, $value, $parameters);
    }

    protected function validateRenavam($attribute, $value): bool
    {
        $renavam = new Renavam();

        return $renavam->validateRenavam($attribute, $value);
    }

    protected function validatePlaca($attribute, $value): bool
    {
        $placa = new Placa();

        return $placa->validatePlaca($attribute, $value);
    }

    protected function validateDdd($attribute, $value): bool
    {
        $ddd = new Ddd();

        return $ddd->validateDdd($attribute, $value);
    }
}
