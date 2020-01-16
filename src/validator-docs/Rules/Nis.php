<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function mb_strlen;
use function sprintf;
use function preg_match;

final class Nis extends Sanitization
{
    public function validateNis($attribute, $value): bool
    {
        $nis = sprintf('%011s', $this->sanitize($value));

        if (mb_strlen($nis) != 11 || preg_match("/^{$nis[0]}{11}$/", $nis)) {
            return false;
        }

        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));
    }
}
