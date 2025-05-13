<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function preg_match;
use function mb_strlen;

final class Cpf extends Sanitization
{
    public function validateCpf($attribute, $value): bool
    {
        $c = $this->sanitize($value);

        if (mb_strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for (
            $s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for (
            $s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}
