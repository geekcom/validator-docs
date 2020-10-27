<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use Thiagocfn\InscricaoEstadual\Util\Validador;

use function mb_strtoupper;

final class InscricaoEstadual extends Sanitization
{
    public function validateInscricaoEstadual($attribute, $value, $parameters)
    {
        if (empty($parameters[0]) || !is_string($parameters[0])) {
            return false;
        }

        $siglaUf = $this->sanitizeSiglaUf($parameters[0]);
        $inscricaoEstadual = $this->sanitize($value);

        return Validador::check($siglaUf, $inscricaoEstadual);
    }

    /**
     * @param mixed $siglaUf
     * @return false|string|string[]
     */
    private function sanitizeSiglaUf($siglaUf)
    {
        return mb_strtoupper($siglaUf);
    }
}
