<?php

namespace geekcom\ValidatorDocs\Rules;

use function preg_match;

final class Ddd
{
    public function validateDdd($attribute, $ddd): bool
    {
        if (preg_match('/([1-9]{2}+)/', $ddd, $matches) <= 0) {
            return false;
        }

        $dddExtracted = (int) $matches[0];

        $dddExisting = array_merge(
            range(11, 19),
            [21, 22, 24, 27, 28],
            range(31, 35),
            [37, 38],
            range(41, 49),
            [51],
            range(53, 55),
            range(61, 69),
            [71],
            range(73, 75),
            [77, 79],
            range(81, 89),
            range(91, 99)
        );

        return in_array($dddExtracted, $dddExisting);
    }
}
