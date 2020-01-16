<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function mb_strlen;
use function preg_match;

final class Cnpj extends Sanitization
{
    public function validateCnpj($attribute, $value): bool
    {
        $c = $this->sanitize($value);

        if (mb_strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for (
            $i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]
        ) {
        }

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for (
            $i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]
        ) {
        }

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}
