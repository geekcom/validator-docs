<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function mb_strlen;
use function is_scalar;

final class Cnh extends Sanitization
{
    /**
     * Trecho retirado do respect validation
     */
    public function validateCnh($attribute, $value): bool
    {
        $value = $this->sanitize($value);

        if (!is_scalar($value)) {
            return false;
        }

        if (mb_strlen($value) != 11 || ((int) $value === 0)) {
            return false;
        }

        for ($c = $s1 = $s2 = 0, $p = 9; $c < 9; $c++, $p--) {
            $s1 += (int) $value[$c] * $p;
            $s2 += (int) $value[$c] * (10 - $p);
        }

        $dv1 = $s1 % 11;
        if ($value[9] != ($dv1 > 9) ? 0 : $dv1) {
            return false;
        }

        $dv2 = $s2 % 11 - ($dv1 > 9 ? 2 : 0);

        $check = $dv2 < 0 ? $dv2 + 11 : ($dv2 > 9 ? 0 : $dv2);

        return $value[10] == $check;
    }
}