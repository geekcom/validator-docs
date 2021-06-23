<?php

namespace geekcom\ValidatorDocs\Contracts;

interface ValidatorFormats
{
    public static function validateFormat(string $value): bool;
}
