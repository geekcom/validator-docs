<?php

namespace geekcom\ValidatorDocs\Formats;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats;

class Cnpj implements ValidatorFormats
{
    public static function validateFormat(string $value): bool
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }
}
