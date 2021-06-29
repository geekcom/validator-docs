<?php

namespace geekcom\ValidatorDocs\Formats;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats;

class Certidao implements ValidatorFormats
{
    public static function validateFormat(string $value): bool
    {
        return preg_match(
            '/^\d{6}[. ]\d{2}[. ]\d{2}[. ]\d{4}[. ]\d{1}[. ]\d{5}[. ]\d{3}[. ]\d{7}[- ]\d{2}$/',
            $value
        ) > 0;
    }
}
