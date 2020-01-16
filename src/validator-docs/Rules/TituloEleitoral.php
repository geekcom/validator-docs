<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function substr;
use function mb_strlen;
use function str_repeat;

final class TituloEleitoral extends Sanitization
{
    public function validateTituloEleitor($attribute, $value): bool
    {
        $input = $this->sanitize($value);

        $uf = substr($input, -4, 2);

        if (
            ((mb_strlen($input) < 5) || (mb_strlen($input) > 13)) ||
            (str_repeat($input[1], mb_strlen($input)) == $input) ||
            ($uf < 1 || $uf > 28)
        ) {
            return false;
        }

        $dv = substr($input, -2);
        $base = 2;

        $sequencia = substr($input, 0, -4);

        for ($i = 0; $i < 2; $i++) {
            $fator = 9;
            $soma = 0;

            for ($j = (mb_strlen($sequencia) - 1); $j > -1; $j--) {
                $soma += $sequencia[$j] * $fator;

                if ($fator == $base) {
                    $fator = 10;
                }

                $fator--;
            }

            $digito = $soma % 11;

            if (($digito == 0) and ($uf < 3)) {
                $digito = 1;
            } elseif ($digito == 10) {
                $digito = 0;
            }

            if ($dv[$i] != $digito) {
                return false;
            }

            switch ($i) {
                case '0':
                    $sequencia = $uf . $digito;
                    break;
            }
        }

        return true;
    }
}
