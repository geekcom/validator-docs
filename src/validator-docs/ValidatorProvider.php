<?php

namespace geekcom\ValidatorDocs;

use Illuminate\Support\ServiceProvider;

class ValidatorProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $me = $this;

        $validatorFormats = new ValidatorFormats();

        $this->app['validator']
            ->resolver(
                function ($translator, $data, $rules, $messages, $attributes) use ($me, $validatorFormats) {
                    $messages += $me->getMessages();

                    return new Validator($translator, $validatorFormats, $data, $rules, $messages, $attributes);
                }
            );
    }

    protected function getMessages()
    {
        return [
            'cnh' => 'Carteira Nacional de Habilitação inválida',
            'titulo_eleitor' => 'Título de Eleitor inválido',
            'cnpj' => 'CNPJ inválido',
            'cpf' => 'CPF inválido',
            'renavam' => 'Renavam inválido',
            'cpf_cnpj' => 'CPF ou CNPJ inválido',
            'nis' => 'PIS/PASEP/NIT/NIS inválido',
            'cns' => 'Cartão Nacional de Saúde inválido',
            'inscricao_estadual' => 'Inscrição Estadual ou UF inválidas',
            'certidao' => 'Número da Certidão inválido',
            'ddd' => 'DDD inválido',
            'formato_cnpj' => 'Formato inválido para CNPJ',
            'formato_cpf' => 'Formato inválido para CPF',
            'formato_cpf_cnpj' => 'Formato inválido para CPF ou CNPJ',
            'formato_nis' => 'Formato inválido para PIS/PASEP/NIT/NIS',
            'formato_certidao' => 'Formato inválido para Certidão',
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
