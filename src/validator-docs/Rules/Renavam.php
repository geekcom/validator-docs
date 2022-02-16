<?php

namespace geekcom\ValidatorDocs\Rules;

use function str_split;

class Renavam extends Sanitization
{
    /**
     * The renavam string size.
     */
    protected const RENAVAM_SIZE = 11;

    /**
     * Validate the renavam.
     *
     * @param $attribute
     * @param $renavam
     * @return bool
     */
    public function validateRenavam($attribute, $renavam): bool
    {
        $renavam = $this->sanitize((string) $renavam);
        if (!$this->renavamHasCorrectLength($renavam)) {
            return false;
        }

        $realLastDigit = $this->getRealLastDigit($renavam);
        $informedLastDigit = (int) substr($renavam, strlen($renavam) - 1, strlen($renavam));

        return $realLastDigit === $informedLastDigit;
    }


    /**
     * Sanitize the renavam value.
     *
     * @param $value
     * @return string
     */
    public function sanitize($value): string
    {
        $renavam = parent::sanitize((string) $value);
        if (preg_match("/^([0-9]{9})$/", $renavam)) {
            $renavam = '00' . $renavam;
        }

        if (preg_match("/^([0-9]{10})$/", $renavam)) {
            $renavam = '0' . $renavam;
        }

        return $renavam;
    }

    /**
     * Check if renavam has correct length.
     *
     * @param string $renavam
     * @return bool
     */
    protected function renavamHasCorrectLength(string $renavam): bool
    {
        return !!preg_match("/[0-9]{11}/", $renavam);
    }

    /**
     * Get the real last digit calculated.
     *
     * @param string $renavam
     * @return int
     */
    private function getRealLastDigit(string $renavam): int
    {
        $renavamReverseWithoutDigit = $this->sanitizeToReverseWithoutDigit($renavam);
        $sum = $this->calcSumByRenavamReverseWithoutDigit($renavamReverseWithoutDigit);

        $mod11 = $sum % self::RENAVAM_SIZE;
        $lastDigitCalculated = self::RENAVAM_SIZE - $mod11;

        return $lastDigitCalculated >= 10 ? 0 : $lastDigitCalculated;
    }

    /**
     * Sanitize the renavam to without digit.
     *
     * @param string $renavam
     * @return string
     */
    protected function sanitizeToReverseWithoutDigit(string $renavam): string
    {
        $renavamWithoutDigit = substr($renavam, 0, 10);

        return strrev($renavamWithoutDigit);
    }

    /**
     * Calculate the sum value by renavam reverse without digit.
     *
     * @param string $renavamReverseWithoutDigit
     * @return int
     */
    protected function calcSumByRenavamReverseWithoutDigit(string $renavamReverseWithoutDigit): int
    {
        $sum = 0;

        for ($i = 0; $i < 8; $i++) {
            $numeral = (int) substr($renavamReverseWithoutDigit, $i, 1);
            $multiplier = $i + 2;
            $sum += $numeral * $multiplier;
        }

        $sum += $renavamReverseWithoutDigit[8] * 2;
        $sum += $renavamReverseWithoutDigit[9] * 3;

        return $sum;
    }
}
