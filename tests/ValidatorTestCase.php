<?php

namespace geekcom\ValidatorDocs\Tests;

use geekcom\ValidatorDocs\ValidatorProvider;
use Orchestra\Testbench\TestCase;

abstract class ValidatorTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app->register(ValidatorProvider::class);
    }
}
