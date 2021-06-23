<?php

namespace geekcom\ValidatorDocs\Formats;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats;

class Cpf implements ValidatorFormats
{
    public static function validateFormat(string $value): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }
}
