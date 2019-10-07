<?php

namespace geekcom\ValidatorDocs\Tests;

use Orchestra\Testbench\TestCase;

abstract class ValidatorTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app->register(\geekcom\ValidatorDocs\ValidatorProvider::class);
    }
}