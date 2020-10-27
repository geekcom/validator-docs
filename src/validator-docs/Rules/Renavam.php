<?php

namespace geekcom\ValidatorDocs\Rules;

use function str_split;

class Renavam extends Sanitization
{
    public function validateRenavam($attribute, $renavam): bool
    {
        $renavam = $this->sanitize($renavam);
        $sum = 0;
        $renavamArray = str_split($renavam);
        $digitCount = 0;

        for ($i = 5; $i >= 2; $i--) {
            $sum += $renavamArray[$digitCount] * $i;
            $digitCount++;
        }

        $valor = $sum % 11;

        $digit = $valor;

        if ($valor == 11 || $valor == 0 || $valor >= 10) {
            $digit = 0;
        }

        if ($digit == $renavamArray[4]) {
            return true;
        }

        return false;
    }
}
