<?php

namespace geekcom\ValidatorDocs;

use geekcom\ValidatorDocs\Contracts\ValidatorFormats as Contract;
use Exception;

class ValidatorFormats
{
    private const STRATEGY_NAMESPACE = 'geekcom\ValidatorDocs\Formats\%s';

    public function execute(string $value, string $document): bool
    {
        if (!$value) {
            throw new Exception('Value not informed.');
        }

        $validator = sprintf(self::STRATEGY_NAMESPACE, ucfirst($document));
        if (
            class_exists($validator)
            && new $validator() instanceof Contract
        ) {
            return $validator::validateFormat($value);
        }

        throw new Exception('Don\'t exists validator for this document.');
    }
}
