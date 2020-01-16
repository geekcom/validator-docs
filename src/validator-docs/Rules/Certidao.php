<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function mb_strlen;
use function preg_match;
use function substr;

final class Certidao extends Sanitization
{
    /*
     * CERTIDÃO DE NASCIMENTO/CASAMENTO/ÓBITO
     * Fonte: http://ghiorzi.org/DVnew.htm#zc
     *
     * Nota: se o resto for "10", o DV será "1"
     */
    public function validateCertidao($attribute, $value): bool
    {
        $certidao = $this->sanitize($value);

        if (!preg_match("/[0-9]{32}/", $certidao)) {
            return false;
        }

        $num = substr($certidao, 0, -2);
        $dv = substr($certidao, -2);

        $dv1 = $this->somaPonderadaCertidao($num) % 11;
        $dv1 = $dv1 > 9 ? 1 : $dv1;
        $dv2 = $this->somaPonderadaCertidao($num . $dv1) % 11;
        $dv2 = $dv2 > 9 ? 1 : $dv2;

        // Compara o dv recebido com os dois numeros calculados
        if ($dv === $dv1 . $dv2) {
            return true;
        }

        return false;
    }

    private function somaPonderadaCertidao($value): int
    {
        $soma = 0;

        $multiplicador = 32 - mb_strlen($value);

        for ($i = 0; $i < mb_strlen($value); $i++) {
            $soma += $value[$i] * $multiplicador;

            $multiplicador += 1;
            $multiplicador = $multiplicador > 10 ? 0 : $multiplicador;
        }

        return $soma;
    }
}
