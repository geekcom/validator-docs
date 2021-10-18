# Validator Docs - Brasil
_Biblioteca PHP para validação de documentos do Brasil usando **Laravel**_

[![Build Status](https://app.travis-ci.com/geekcom/validator-docs.svg?branch=master)](https://travis-ci.com/geekcom/validator-docs)
[![Coverage Status](https://coveralls.io/repos/github/geekcom/validator-docs/badge.svg?branch=master)](https://coveralls.io/github/geekcom/validator-docs?branch=master)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)
[![Total Downloads](https://poser.pugx.org/geekcom/validator-docs/downloads)](https://packagist.org/packages/geekcom/validator-docs)
[![License](https://poser.pugx.org/geekcom/validator-docs/license)](https://packagist.org/packages/geekcom/validator-docs)

> ### Por favor, considere **[fazer uma doação](https://nubank.com.br/pagar/518o5/zVBzxd00Sb)**, apoie nossas atividades

> Para a versão legada compatível com Laravel 5 consulte o branch https://github.com/geekcom/validator-docs/tree/5.x.x

## Recursos
- Validar qualquer documento do Brasil;
- Código testado e confiável;
- Open Source;
- Usado por milhares de sistemas.

## Instalação
No arquivo `composer.json`, adicione validator-docs como dependência do seu projeto:

```
"require": {
    "geekcom/validator-docs" : "^3.5"
 },
```

Depois execute:

```
composer install
```

Ou simplesmente execute o comando:

```
composer require geekcom/validator-docs
```

----------------------------------------------------------------------------------------------------------------------------

## Como usar
Agora que os métodos de validação validator-docs Brasil estão disponíveis, será possível usar da seguinte forma:

* **cpf** - Verifica se um CPF é valido;

```php
$this->validate($request, [
    'cpf' => 'required|cpf',
]);
```

* **cnpj** - Verifica se um CNPJ é valido;

```php
$this->validate($request, [
    'cnpj' => 'required|cnpj',
]);
```

* **cnh** - Verifica se uma CNH (Carteira Nacional de Habilitação) é válida;

```php
$this->validate($request, [
    'cnh' => 'required|cnh',
]);
```

* **titulo_eleitor** - Verifica se um Título de Eleitor é válido;

```php
$this->validate($request, [
    'titulo_eleitor' => 'required|titulo_eleitor',
]);
```

* **cpf_cnpj** - Verifica se um CPF ou CNPJ é válido;

```php
$this->validate($request, [
    'cpf_cnpj' => 'required|cpf_cnpj',
]);
```

* **inscricao_estadual** - Verifica se uma Inscrição Estadual é valida para uma Unidade Federativa(UF)/Estado;

```php
$this->validate($request, [
    'inscricao_estadual:UF' => 'required|inscricao_estadual:UF',
]);
```

* **nis** - Verifica se um PIS/PASEP/NIT/NIS é válido;

```php
$this->validate($request, [
    'nis' => 'required|nis',
]);
```

* **cns** - Verifica se um Cartão Nacional de Saúde (CNS) é válido;

```php
$this->validate($request, [
    'cns' => 'required|cns',
]);
```

* **certidao** - Verifica se uma certidão de nascimento/casamento/óbito é válida;

```php
$this->validate($request, [
    'certidao' => 'required|certidao',
]);
```

* **renavam** - Verifica se um Registro Nacional de Veículos Automotores (RENAVAM) é válido;

```php
$this->validate($request, [
    'renavam' => 'required|renavam',
]);
```

* **placa** - Verifica se a PLACA de um veículo é válida;

```php
$this->validate($request, [
    'placa' => 'required|placa',
]);
```

* **ddd** - Verifica se um número de DDD é válido;

```php
$this->validate($request, [
    'ddd' => 'required|ddd',
]);
```

* **formato_cnpj** - Verifica se o formato`(99.999.999/9999-99)` de um CNPJ é válido;

```php
$this->validate($request, [
    'formato_cnpj' => 'required|formato_cnpj',
]);
```

* **formato_cpf** - Verifica se o formato(`999.999.999-99`) de um CPF é válido; 

```php
$this->validate($request, [
    'formato_cpf' => 'required|formato_cpf',
]);
```

* **formato_cpf_cnpj** - Verifica se o formato de um CPF ou de um CNPJ é válido;

```php
$this->validate($request, [
    'formato_cpf_cnpj' => 'required|formato_cpf_cnpj',
]);
```

* **formato_nis** - Verifica se o formato(`999.99999-99.9`) de um PIS/PASEP/NIT/NIS é válido;

```php
$this->validate($request, [
    'formato_nis' => 'required|formato_nis',
]);
```

* **formato_certidao** - Verifica se o formato(`99999.99.99.9999.9.99999.999.9999999-99` ou `99999 99 99 9999 9 99999 999 9999999 99`), de uma certidão é válida.

```php
$this->validate($request, [
    'formato_certidao' => 'required|formato_certidao',
]);
```
----------------------------------------------------------------------------------------------------------------------------

## Combinando validação e formato
No exemplo abaixo, fazemos um teste onde verificamos a formatação e a validade de um CPF ou CNPJ, para os casos onde a informação deve ser salva em um mesmo atributo:

```php
$this->validate($request, [
    'cpf_or_cnpj' => 'formato_cpf_cnpj|cpf_cnpj',
]);
```

----------------------------------------------------------------------------------------------------------------------------

## Exemplo de uso em um controller
Método de validação de exemplo em um controller com todas as possibilidades de validação

```php
public function store(Request $request)
{
    $data = $request->all();

    $this->validate($request, [
        'cpf' => 'required|cpf',
        'cnpj' => 'required|cnpj',
        'cnh' => 'required|cnh',
        'titulo_eleitor' => 'required|titulo_eleitor',
        'nis' => 'required|nis',
        'cns' => 'required|cns',
        'renavam' => 'required|renavam',
        'placa' => 'required|placa',
        'certidao' => 'required|certidao',
        'inscricao_estadual:UF' => 'required|inscricao_estadual:UF',
    ]);

    dd($data);
}
```
**Observe que para validar uma inscrição estadual é necessário informar a [UF](https://pt.wikipedia.org/wiki/Unidades_federativas_do_Brasil)**

----------------------------------------------------------------------------------------------------------------------------

## Geradores de documentos para testes
* **CNH** - http://4devs.com.br/gerador_de_cnh
* **TÍTULO ELEITORAL** - http://4devs.com.br/gerador_de_titulo_de_eleitor
* **CNPJ** - https://geradornv.com.br/gerador-cnpj/
* **CPF** - https://geradornv.com.br/gerador-cpf/
* **NIS** - https://www.4devs.com.br/gerador_de_pis_pasep
* **CNS** - https://geradornv.com.br/gerador-cns/
* **CERTIDÃO** - https://www.treinaweb.com.br/ferramentas-para-desenvolvedores/gerador/certidao
* **INSCRIÇÃO ESTADUAL** - https://www.4devs.com.br/gerador_de_inscricao_estadual
* **RENAVAM** - https://www.4devs.com.br/gerador_de_renavam
* **PLACA** - https://www.4devs.com.br/gerador_de_placa_automoveis

Fique a vontade para contribuir de qualquer forma.

Caso tenha alguma dúvida ou encontre algum bug, abra uma [issue](https://github.com/geekcom/validator-docs/issues) ou pesquise por issues antigas.

## [Contribuidores](https://github.com/geekcom/validator-docs/graphs/contributors)
Contribuições de qualquer tipo são bem-vindas!
