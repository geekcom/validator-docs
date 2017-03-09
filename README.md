#Validator Docs Brasil 1.0

Biblioteca para validação dos seguintes documentos: CPF, CNPJ e CNH.

#Instalação

No arquivo `composer.json`, adicione:

```json
"require": {
    "geekcom/validator-docs" : "1.*"
    },
```

Agora execute o comando `composer update --no-scripts`.

Após a instalação, adicione no arquivo `config/app.php` no array `providers` a seguinte linha:

```php
geekcom\ValidatorDocs\ValidatorProvider::class
```

Para utilizar a validação agora, basta fazer o procedimento padrão do `Laravel`, confira na documentação especifica para a sua versão
a diferença é que agora, você terá os seguintes métodos de validação:

* cnpj - Verifica se o CNPJ é valido. Para testar, basta utilizar o site http://www.geradorcnpj.com/
* cpf - Verifica se o cpf é valido. Para testar, basta utilizar o site http://geradordecpf.
org
* formato_cnpj - Verifica se a mascara do CNPJ é válida. ( 99.999.999/9999-99 )
* formato_cpf - Verifica se a mascara do cpf é válida. ( 999.999.999-99 )


Então, podemos usar um simples teste onde dizemos que o campo CPF será obrigatório e usamos a biblioteca para validar:

```php
$this->validate($request, [
            'cpf' => 'required|cpf',
        ]);

```


Já existe nessa biblioteca algumas mensagens padrão. 

Para modificar isso, basta adicionar ao terceiro parâmetro de `Validator::make`, um array, contendo o índice com o nome da validação e o valor com a mensagem desejada.


Exemplo de uso em um controller:

```php
$dados = $request->all();

$rules = [
	'cpf' => 'required|unique:pessoa|cpf',  
];

$messages = [
	'documento.cpf' => 'o CPF digitado é inválido',    
];

$validator = Validator::make($dados, $rules, $messages);
if ($validator->fails()) {
	return redirect()->back()->withInput()->withErrors($validator);
}

```

Qualquer dúvida envie-me um email e fique a vontade para contribuir. XD

danielrodrigues-ti@hotmail.com


