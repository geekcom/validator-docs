# LaraValidator Docs - Brasil
_Validação de documentos do Brasil usando **Laravel 6**_

[![Build Status](https://travis-ci.org/geekcom/validator-docs.svg?branch=master)](https://travis-ci.org/geekcom/validator-docs)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/geekcom/validator-docs/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/geekcom/validator-docs/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/geekcom/validator-docs/badge.svg?branch=master)](https://coveralls.io/github/geekcom/validator-docs?branch=master)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)
[![Total Downloads](https://poser.pugx.org/geekcom/validator-docs/downloads)](https://packagist.org/packages/geekcom/validator-docs)
[![License](https://poser.pugx.org/geekcom/validator-docs/license)](https://packagist.org/packages/geekcom/validator-docs)

> Para a versão compatível com Laravel 5 consulte o branch https://github.com/geekcom/validator-docs/tree/5.x.x

Biblioteca Laravel para validação de CPF, CNPJ, CPF/CNPJ (quando salvos no mesmo atributo), CNH, PIS/PASEP/NIT/NIS, Título de Eleitor, Cartão Nacional de Saúde(CNS) e Certidões(nascimento/casamento/óbito).

## Instalação

No arquivo `composer.json`, adicione validator-docs como dependência do seu projeto:

```
"require": {
    "geekcom/validator-docs" : "^3.3"
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

## Como usar - Validações disponíveis

Agora, você terá os métodos de validação validator docs Brasil disponíveis.

* **cpf** - Verifica se um CPF é valido.

```php
$this->validate($request, [
    'cpf' => 'required|cpf',
]);
```

* **cnpj** - Verifica se um CNPJ é valido.

```php
$this->validate($request, [
    'cnpj' => 'required|cnpj',
]);
```

* **cnh** - Verifica se uma CNH (Carteira Nacional de Habilitação) é válida.

```php
$this->validate($request, [
    'cnh' => 'required|cnh',
]);
```

* **titulo_eleitor** - Verifica se um Título de Eleitor é válido.

```php
$this->validate($request, [
    'titulo_eleitor' => 'required|titulo_eleitor',
]);
```

* **cpf_cnpj** - Verifica se um CPF ou CNPJ é válido.

```php
$this->validate($request, [
    'cpf_cnpj' => 'required|cpf_cnpj',
]);
```

* **nis** - Verifica se um PIS/PASEP/NIT/NIS é válido.

```php
$this->validate($request, [
    'nis' => 'required|nis',
]);
```

* **cns** - Verifica se um Cartão Nciona de Saúde (CNS) é válido.

```php
$this->validate($request, [
    'cns' => 'required|cns',
]);
```

* **certidao** - Verifica se uma certidão de nascimento/casamento/óbito é válida.

```php
$this->validate($request, [
    'certidao' => 'required|certidao',
]);
```

* **formato_cnpj** - Verifica se o formato de um CNPJ é válida. ( 99.999.999/9999-99 )

```php
$this->validate($request, [
    'formato_cnpj' => 'required|formato_cnpj',
]);
```

* **formato_cpf** - Verifica se o formato de um CPF é válido. ( 999.999.999-99 )

```php
$this->validate($request, [
    'formato_cpf' => 'required|formato_cpf',
]);
```

* **formato_cpf_cnpj** - Verifica se o formato de um CPF ou um CNPJ é válido. ( 999.999.999-99 ) ou ( 99.999.999/9999-99 )

```php
$this->validate($request, [
    'formato_cpf_cnpj' => 'required|formato_cpf_cnpj',
]);
```

* **formato_nis** - Verifica se o formato de um PIS/PASEP/NIT/NIS é válido. ( 999.99999-99.9 )

```php
$this->validate($request, [
    'formato_nis' => 'required|formato_nis',
]);
```

* **formato_certidao** - Verifica se o formato de uma certidão é válida. ( 99999.99.99.9999.9.99999.999.9999999-99 ou 99999 99 99 9999 9 99999 999 9999999 99)

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
    ]);

    dd($data);
}
```

----------------------------------------------------------------------------------------------------------------------------

## Geradores de documentos para testes

* **CNH** - http://4devs.com.br/gerador_de_cnh
* **TÍTULO ELEITORAL** - http://4devs.com.br/gerador_de_titulo_de_eleitor
* **CNPJ** - http://www.geradorcnpj.com/
* **CPF** - http://geradordecpf.org
* **NIS** - https://www.4devs.com.br/gerador_de_pis_pasep
* **CNS** - https://geradornv.com.br/gerador-cns/
* **CERTIDÃO** - https://www.treinaweb.com.br/ferramentas-para-desenvolvedores/gerador/certidao

Fique a vontade para contribuir fazendo um fork.

Caso tenha alguma dúvida ou encontre algum bug, abra uma [issue](https://github.com/geekcom/validator-docs/issues) ou pesquise por issues antigas.