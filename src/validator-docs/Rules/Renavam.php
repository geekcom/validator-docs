<?php

namespace geekcom\ValidatorDocs\Rules;

use function str_split;

class Renavam extends Sanitization
{
    public function validateRenavam($attribute, $renavam): bool
    {
        $renavam = $this->sanitize((string) $renavam);
        $renavamArray = str_split($renavam);
        $digit = $this->determinarDigito($renavamArray);

        return $digit === (int) $renavamArray[4];
    }

    public function determinarDigito($renavam): int
    {
        $resultante = 0;
        $contador = 0;

        for ($indice = 5; $indice >= 2; $indice--) {
            $resultante += $renavam[$contador] * $indice;
            $contador++;
        }

        $verificador = $resultante % 11;

        return $verificador >= 10 ? 0 : $verificador;
    }
}
