<?php

namespace geekcom\ValidatorDocs;

use Illuminate\Validation\Validator as BaseValidator;

/**
 *
 * @author Daniel Rodrigues Lima
 * @email danielrodrigues-ti@hotmail.com
 */
class Validator extends BaseValidator
{
    /**
     * Valida o formato do cpf
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateFormatoCpf($attribute, $value)
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }

    /**
     * Valida o formato do cnpj
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateFormatoCnpj($attribute, $value)
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }

    /**
     * Valida o formato do cpf ou cnpj
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateFormatoCpfCnpj($attribute, $value)
    {
        return $this->validateFormatoCpf($attribute, $value) || $this->validateFormatoCnpj($attribute, $value);
    }

    /**
     * Valida se o CPF é válido
     * @param string $attribute
     * @param string $value
     * @return boolean
     */

    protected function validateCpf($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) ;

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) ;

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;

    }

    /**
     * Valida se o CNPJ é válido
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateCnpj($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]) ;

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]) ;

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;

    }

    /**
     * Valida se o CNPJ é válido
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateCpfCnpj($attribute, $value)
    {
        return ($this->validateCpf($attribute, $value) || $this->validateCnpj($attribute, $value));
    }

    /**
     * Valida se o CNH é válido
     * @param string $attribute
     * @param string $value
     * @return boolean
     */

    protected function validateCnh($attribute, $value)
    {
        // Trecho retirado do respect validation

        $ret = false;

        if ((strlen($input = preg_replace('/[^\d]/', '', $value)) == 11)
            && (str_repeat($input[1], 11) != $input)
        ) {
            $dsc = 0;

            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {

                $v += (int)$input[$i] * $j;

            }

            if (($vl1 = $v % 11) >= 10) {

                $vl1 = 0;
                $dsc = 2;

            }

            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {

                $v += (int)$input[$i] * $j;

            }

            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;

            $ret = sprintf('%d%d', $vl1, $vl2) == substr($input, -2);
        }

        return $ret;
    }

}
