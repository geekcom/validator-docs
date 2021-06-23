<?php

namespace geekcom\ValidatorDocs\Tests;

use Illuminate\Support\Facades\Validator;

final class TestValidator extends ValidatorTestCase
{
    /** @test **/
    public function cpf()
    {
        $correct = Validator::make(
            ['certo' => '094.050.986-59'],
            ['certo' => 'cpf']
        );

        $incorrect = Validator::make(
            ['errado' => '99800-1926'],
            ['errado' => 'cpf']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function cnpj()
    {
        $correct = Validator::make(
            ['certo' => '53.084.587/0001-20'],
            ['certo' => 'cnpj']
        );

        $incorrect = Validator::make(
            ['errado' => '51.084.587/0001-20'],
            ['errado' => 'cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function cpfECnpjNoMesmoAtributo()
    {
        $correct = Validator::make(
            ['certo' => '53.084.587/0001-20'],
            ['certo' => 'cpf-cnpj']
        );

        $incorrect = \Validator::make(
            ['errado' => '99800-1926'],
            ['errado' => 'cpf-cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function cnh()
    {
        $correct = Validator::make(
            ['certo' => '96784547943'],
            ['certo' => 'cnh']
        );

        $incorrect = Validator::make(
            ['errado' => '96784547999'],
            ['errado' => 'cnh']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());

        $correct = \Validator::make(
            ['certo' => '04463004100'],
            ['certo' => 'cnh']
        );

        $this->assertTrue($correct->passes());
    }

    /** @test **/
    public function tituloEleitoral()
    {
        $correct = Validator::make(
            ['certo' => '3021260'],
            ['certo' => 'titulo_eleitor']
        );

        $incorrect = Validator::make(
            ['errado' => '1000101230190'],
            ['errado' => 'titulo_eleitor']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function nis()
    {
        $correct = Validator::make(
            ['certo' => '201.73374.34-9'],
            ['certo' => 'nis']
        );

        $incorrect = Validator::make(
            ['errado' => '201.73374.34-0'],
            ['errado' => 'nis']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function cns()
    {
        // Definitiva
        $correct = Validator::make(
            ['certo' => '116 3876 9194 0009'],
            ['certo' => 'cns']
        );

        $incorrect = Validator::make(
            ['errado' => '116 5698 9194 0009'],
            ['errado' => 'cns']
        );

        $this->assertTrue($correct->passes());
        $this->assertTrue($incorrect->fails());

        // Provisória
        $correct = Validator::make(
            ['certo' => '892 1623 5477 0008'],
            ['certo' => 'cns']
        );

        $incorrect = Validator::make(
            ['errado' => '892 2641 5477 0008'],
            ['errado' => 'cns']
        );

        $this->assertTrue($correct->passes());
        $this->assertTrue($incorrect->fails());
    }

    /** @test **/
    public function certidao()
    {
        $correct = Validator::make(
            ['certo' => '659447 02 55 9015 1 99679 468 2559590-16'],
            ['certo' => 'certidao']
        );

        $incorrect = Validator::make(
            ['errado' => '659447 02 55 2015 1 27861 468 2559590-32'],
            ['errado' => 'certidao']
        );

        $this->assertTrue($correct->passes());
        $this->assertTrue($incorrect->fails());
    }

    public function inscricoesEstaduais()
    {
        $inscricoesEstaduaisValidas = [
            "AC" => "0184765932153",
            "AL" => "248308335",
            "AP" => "039895661",
            "AM" => "292278012",
            "BA" => "96338555",
            "CE" => "980874165",
            "DF" => "0740769300107",
            "ES" => "342048090",
            "GO" => "107900459",
            "MA" => "122917510",
            "MT" => "55160385510",
            "MS" => "283814659",
            "MG" => "0526366324132",
            "PA" => "158330005",
            "PB" => "439622301",
            "PR" => "5714953410",
            "PE" => "920145698",
            "PI" => "758505183",
            "RJ" => "61804315",
            "RN" => "208627715",
            "RS" => "3821957672",
            "RO" => "52059985926850",
            "RR" => "249977060",
            "SC" => "696192667",
            "SP" => "653172024009",
            "SE" => "646597361",
            "TO" => "75036274184",
        ];

        foreach ($inscricoesEstaduaisValidas as $siglaUf => $inscricaoEstadual) {
            $inscricoesEstaduaisValidas[$siglaUf] = [
                'data' => $inscricaoEstadual,
                'rules' => "inscricao_estadual:$siglaUf",
                'assert' => 'passes'
            ];
        }

        return $inscricoesEstaduaisValidas + [
                // válidas
                'válida sem formatação' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:BA',
                    'assert' => 'passes'
                ],
                'válida com estado (UF) em letras minúsculas' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:ba',
                    'assert' => 'passes'
                ],
                'válida com formatação' => [
                    'data' => '826793-41',
                    'rules' => 'inscricao_estadual:BA',
                    'assert' => 'passes'
                ],
                'válida com formatação qualquer não-numérica' => [
                    'data' => '8 2__6-7*9.3/41',
                    'rules' => 'inscricao_estadual:BA',
                    'assert' => 'passes'
                ],

                // inválidas
                'inválida cálculo errado' => [
                    'data' => '82679342', // último digito deveria ser 1
                    'rules' => 'inscricao_estadual:BA',
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) errado' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:SP', // deveria ser BA
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) inexistente' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:ZA',
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) invalido (maior)' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:askdjahsd',
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) invalido (menor)' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:y',
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) invalido (numerico)' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual:12',
                    'assert' => 'fails'
                ],
                'inválida se estado (UF) não informado' => [
                    'data' => '82679341',
                    'rules' => 'inscricao_estadual',
                    'assert' => 'fails'
                ],
            ];
    }

    /**
     * @test
     * @dataProvider inscricoesEstaduais
     * @param $data
     * @param $rules
     * @param $assert
     */
    public function inscricaoEstadual($data, $rules, $assert)
    {
        $correct = Validator::make(
            ['input_inscricao_estadual' => $data],
            ['input_inscricao_estadual' => $rules]
        );
        $this->assertTrue($correct->{$assert}());
    }

    /** @test**/
    public function formatoRenavam()
    {
        $correct = Validator::make(
            ['certo' => '197073212'],
            ['certo' => 'renavam']
        );

        $incorrect = Validator::make(
            ['errado' => '1234555582'],
            ['errado' => 'renavam']
        );

        $this->assertTrue($correct->passes());
        $this->assertTrue($incorrect->fails());

        $correct = Validator::make(
            ['certo' => '1970.73212'],
            ['certo' => 'renavam']
        );

        $this->assertTrue($correct->passes());
    }

    /** @test **/
    public function placa()
    {
        $correct = Validator::make(
            ['certo' => 'P15186'],
            ['certo' => 'placa']
        );

        $incorrect = Validator::make(
            ['errado' => 'X1234'],
            ['errado' => 'placa']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    /**
     * @test
     */
    public function ddd()
    {
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

        $correct = Validator::make(
            ['certo' => $dddExisting[array_rand($dddExisting)]],
            ['certo' => 'ddd']
        );

        $incorrect = Validator::make(
            ['errado' => '10'],
            ['errado' => 'ddd']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }
}
