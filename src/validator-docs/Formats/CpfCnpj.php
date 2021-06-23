<?php

namespace geekcom\ValidatorDocs\Formats;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats;

class CpfCnpj implements ValidatorFormats
{
    public static function validateFormat(string $value): bool
    {
        $cpf = new Cpf();
        $cnpj = new Cnpj();

        return $cpf->validateFormat($value) || $cnpj->validateFormat($value);
    }
}
