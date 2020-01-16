<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function mb_strlen;
use function is_scalar;

final class Cnh extends Sanitization
{
    /**
     * @author Evandro Kondrat
     * Trecho reescrito com base no algoritmo passado pelo Detran-PR
     */
    public function validateCnh($attribute, $value): bool
    {
        if (!is_scalar($value)) {
            return false;
        }

        $value = $this->sanitize($value);

        if (mb_strlen($value) != 11 || ((int) $value === 0)) {
            return false;
        }

        $parcial = substr($value, 0, 9);

        for ($i = 0 , $j = 2, $s = 0; $i < mb_strlen($parcial); $i++, $j++) {
            $s += (int) $parcial[$i] * $j;
        }

        $resto = $s % 11;
        if ($resto <= 1) {
            $dv1 = 0;
        } else {
            $dv1 = 11 - $resto;
        }

        $parcial = $dv1 . $parcial;

        for ($i = 0, $j = 2, $s = 0; $i < mb_strlen($parcial); $i++, $j++) {
            $s += (int) $parcial[$i] * $j;
        }

        $resto = $s % 11;
        if ($resto <= 1) {
            $dv2 = 0;
        } else {
            $dv2 = 11 - $resto;
        }

        return $dv1 . $dv2 == substr($value, -2);
    }
}
