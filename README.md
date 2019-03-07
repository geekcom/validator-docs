# Validator Docs - Brasil
_Validação de documentos do Brasil usando Laravel 5.*_

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/geekcom/validator-docs/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/geekcom/validator-docs/?branch=master)
[![Total Downloads](https://poser.pugx.org/geekcom/validator-docs/downloads)](https://packagist.org/packages/geekcom/validator-docs)
[![License](https://poser.pugx.org/geekcom/validator-docs/license)](https://packagist.org/packages/geekcom/validator-docs)

Biblioteca Laravel para validação de CPF, CNPJ, CPF/CNPJ (quando salvos no mesmo atributo), CNH e Título de Eleitor.

# Instalação

No arquivo `composer.json`, adicione:

```
"require": {
    "geekcom/validator-docs" : "1.*"
 },
```

Ou rode o comando:

```
composer require geekcom/validator-docs
```

Após a instalação, adicione no arquivo `config/app.php` no array `providers` a seguinte linha:

```php
geekcom\ValidatorDocs\ValidatorProvider::class
```

Para utilizar a validação agora, basta fazer o procedimento padrão do `Laravel`, confira na documentação especifica para a sua versão,
a diferença é que agora, você terá os seguintes métodos de validação:

* **cnh** - Verifica se uma CNH é valida. Para testar, basta utilizar o site http://4devs.com.br/gerador_de_cnh
* **titulo_eleitor** - Verifica se um Título de Eleitor é valido. Para testar, basta utilizar o site http://4devs.com.br/gerador_de_titulo_de_eleitor
* **cnpj** - Verifica se o CNPJ é valido. Para testar, basta utilizar o site http://www.geradorcnpj.com/
* **cpf** - Verifica se o CPF é valido. Para testar, basta utilizar o site http://geradordecpf.org
* **cpf_cnpj** - Verifica se é um CPF ou CNPJ valido. Para testar, basta utilizar um dos sites acima
* **nis** - Verifica se o PIS/PASEP/NIT/NIS é valido. Para testar, basta utilizar o site https://www.4devs.com.br/gerador_de_pis_pasep
* **formato_cnpj** - Verifica se a mascara do CNPJ é válida. ( 99.999.999/9999-99 )
* **formato_cpf** - Verifica se a mascara do CPF é válida. ( 999.999.999-99 )
* **formato_cpf_cnpj** - Verifica se a mascara do CPF ou CNPJ é válida. ( 999.999.999-99 ) ou ( 99.999.999/9999-99 )
* **formato_nis** - Verifica se a mascara do PIS/PASEP/NIT/NIS é válida. ( 999.99999-99.9 )


Então, podemos realizar um simples teste onde dizemos que o campo CPF será obrigatório e usamos a biblioteca para validar:

```php
$this->validate($request, [
          'cpf' => 'required|cpf',
      ]);
```

No exemplo abaixo, fazemos um teste onde validamos a formatação e a validade de um CPF ou CNPJ, para os casos onde a informação deva ser salva em um mesmo atributo:

```php
$this->validate($request, [
          'cpf_or_cnpj' => 'formato_cpf_cnpj|cpf_cnpj',
      ]);
```

Fique a vontade para contribuir fazendo um fork.
