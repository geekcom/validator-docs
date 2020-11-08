<?php

namespace geekcom\ValidatorDocs\Rules;

use function preg_replace;

final class PisPasep
{
    public function validatePisPasep($attribute, $pisPasep): bool
    {
        $pisPasep = preg_replace('/[^\d]+/', '', $pisPasep);

        if (strlen($pisPasep) !== 11) {
            return false;
        }

        $baseMultiplier = "3298765432";
        $total = 0;
        $rest = 0;
        $multiplying = 0;
        $multiplier = 0;
        $digit = 99;

        for ($i = 0; $i < 10; $i++) {
            $multiplying = (int) substr($pisPasep, $i, 1);
            $multiplier = (int) substr($baseMultiplier, $i, 1);
            $total += $multiplying * $multiplier;
        }

        $rest = 11 - $total % 11;
        $rest = $rest === 10 || $rest === 11 ? 0 : $rest;
        $digit = (int) ("" . $pisPasep[10]);

        return $rest === $digit;
    }
}
