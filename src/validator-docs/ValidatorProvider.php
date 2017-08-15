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

        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $attributes) use ($me) {
            $messages += $me->getMessages();

            return new Validator($translator, $data, $rules, $messages, $attributes);
        });
    }


    protected function getMessages()
    {
        return [
            'cnh' => 'O campo :attribute não é uma carteira nacional de habilitação válida',
            'titulo_eleitor' => 'O campo :attribute não é um título de eleitor válido',
            'cnpj' => 'O campo :attribute não é um CNPJ válido',
            'cpf' => 'O campo :attribute não é um CPF válido',
            'cpf_cnpj' => 'O campo :attribute não é válido',
            'formato_cnpj' => 'O campo :attribute não possui o formato válido de CNPJ',
            'formato_cpf' => 'O campo :attribute não possui o formato válido de CPF',
            'formato_cpf_cnpj' => 'O campo :attribute não possui um formato válido',
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
        return array();
    }

}
