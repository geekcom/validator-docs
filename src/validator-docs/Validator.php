<?php

namespace geekcom\ValidatorDocs;

use Illuminate\Validation\Validator as BaseValidator;

use function preg_match;
use function preg_replace;
use function strlen;
use function str_repeat;
use function sprintf;
use function substr;

/**
 *
 * @author Daniel Rodrigues Lima
 * @email danielrodrigues-ti@hotmail.com
 */
class Validator extends BaseValidator
{
    protected function validateFormatoCpf($attribute, $value)
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }

    protected function validateFormatoCnpj($attribute, $value)
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }

    protected function validateFormatoCpfCnpj($attribute, $value)
    {
        return $this->validateFormatoCpf($attribute, $value) || $this->validateFormatoCnpj($attribute, $value);
    }

    protected function validateFormatoNis($attribute, $value)
    {
        return preg_match('/^\d{3}\.\d{5}\.\d{2}-\d{1}$/', $value) > 0;
    }

    /*
     * O Número de Matrícula tem a configuração aaaaaa.bb.cc.dddd.e.fffff.ggg.hhhhhhh-ii
     */
    protected function validateFormatoCertidao($attribute, $value)
    {
        return preg_match('/^\d{6}[. ]\d{2}[. ]\d{2}[. ]\d{4}[. ]\d{1}[. ]\d{5}[. ]\d{3}[. ]\d{7}[- ]\d{2}$/', $value) > 0;
    }

    protected function validateCpf($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    protected function validateCnpj($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    protected function validateCpfCnpj($attribute, $value)
    {
        return ($this->validateCpf($attribute, $value) || $this->validateCnpj($attribute, $value));
    }

    /**
     * Trecho retirado do respect validation
     */
    protected function validateCnh($attribute, $value)
    {
        $ret = false;

        if ((strlen($input = preg_replace('/[^\d]/', '', $value)) == 11)
            && (str_repeat($input[1], 11) != $input)
        ) {
            $dsc = 0;

            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {
                $v += (int) $input[$i] * $j;
            }

            if (($vl1 = $v % 11) >= 10) {
                $vl1 = 0;
                $dsc = 2;
            }

            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {
                $v += (int) $input[$i] * $j;
            }

            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;

            $ret = sprintf('%d%d', $vl1, $vl2) == substr($input, -2);
        }

        return $ret;
    }

    protected function validateTituloEleitor($attribute, $value)
    {
        $input = preg_replace('/[^\d]/', '', $value);

        $uf = substr($input, -4, 2);

        if (((strlen($input) < 5) || (strlen($input) > 13)) ||
            (str_repeat($input[1], strlen($input)) == $input) ||
            ($uf < 1 || $uf > 28)) {
            return false;
        }

        $dv = substr($input, -2);
        $base = 2;

        $sequencia = substr($input, 0, -4);

        for ($i = 0; $i < 2; $i++) {
            $fator = 9;
            $soma = 0;

            for ($j = (strlen($sequencia) - 1); $j > -1; $j--) {
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

    protected function validateNis($attribute, $value)
    {
        $nis = sprintf('%011s', preg_replace('{\D}', '', $value));

        if (strlen($nis) != 11 || preg_match("/^{$nis[0]}{11}$/", $nis)) {
            return false;
        }

        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));
    }

    protected function validateCns($attribute, $value)
    {
        $cns = preg_replace('/[^\d]/', '', $value);

        // CNSs definitivos começam em 1 ou 2 / CNSs provisórios em 7, 8 ou 9
        if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $cns) || preg_match("/[7-9][0-9]{14}/", $cns)) {
            return $this->somaPonderadaCns($cns) % 11 == 0;
        }

        return false;
    }

    private function somaPonderadaCns($value)
    {
        $soma = 0;

        for ($i = 0; $i < strlen($value); $i++) {
            $soma += $value[$i] * (15 - $i);
        }

        return $soma;
    }
  
    /*
     * CERTIDÃO DE NASCIMENTO/CASAMENTO/ÓBITO
     * Fonte: http://ghiorzi.org/DVnew.htm#zc
     *
     * Nota: se o resto for "10", o DV será "1"
     */
    protected function validateCertidao($attribute, $value)
    {
        // Remove não numericos
        $certidao = preg_replace('/[^\d]/', '', $value);

        if (!preg_match("/[0-9]{32}/", $certidao)) {
            return false;
        }

        $num = substr($certidao, 0, -2);
        $dv = substr($certidao, -2);

        $dv1 = $this->somaPonderadaCertidao($num) % 11;
        $dv1 = $dv1 > 9 ? 1 : $dv1;
        $dv2 = $this->somaPonderadaCertidao($num.$dv1) % 11;
        $dv2 = $dv2 > 9 ? 1 : $dv2;

        // Compara o dv recebido com os dois numeros calculados
        if ($dv === $dv1.$dv2) {
            return true;
        } else {
            return false;
        }
    }

    private function somaPonderadaCertidao($value) {
        $soma = 0;

        $multiplicador = 32 - strlen($value);
        for ($i = 0; $i < strlen($value); $i++) {
            $soma += $value[$i] * $multiplicador;

            $multiplicador += 1;
            $multiplicador = $multiplicador > 10 ? 0 : $multiplicador;
        }

        return $soma;
    }
}
