<?php

namespace geekcom\ValidatorDocs\Formats;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats;

class Cnpj implements ValidatorFormats
{
    public static function validateFormat(string $value): bool
    {
        return preg_match('/^[A-Z\d]{2}\.[A-Z\d]{3}\.[A-Z\d]{3}\/[A-Z\d]{4}-\d{2}$/i', $value) > 0;
    }
}
