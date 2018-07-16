<?php
/**
 * Created by PhpStorm.
 * User: Allfa
 * Date: 13/07/2018
 * Time: 08:27
 */

namespace geekcom\ValidatorDocs;


trait maskDocs
{
    public function getAttribute($key)
    {
        $val = parent::getAttribute($key);
        if (isset($this->docFields) && isset($this->docFields[$key])) {
            switch ($this->docFields[$key]){
                case 'cpf':
                    $val = $this->mask($val, '###.###.###-##');
                    break;
                case 'cnpj':
                    $val = $this->mask($val, '##.###.###/####-##');
                    break;
                case 'cpfcnpj':
                    $val = $this->mask($val, strlen($val) > 11 ? '##.###.###/####-##': '###.###.###-##');
                    break;
                default:
                    throw new \Exception("mascara '$this->docFields[$key]' nao parece ser valida");
            }
        }
        return $val;
    }
    public function setAttribute($key, $val){
        $inner = $val;
        if(isset($this->docFields) && isset($this->docFields[$key])) {
            $inner = str_replace([".", "/", "-"], "", $inner);
        }
        parent::setAttribute($key, $inner);
    }

    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

}