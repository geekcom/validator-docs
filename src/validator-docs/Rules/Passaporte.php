<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

final class Passaporte extends Sanitization
{
    public function validatePassaporte($attribute, $value): bool
    {
        return preg_match('/^[A-Za-z]{2}\d{6}$/i', $value) > 0;
    }
}
