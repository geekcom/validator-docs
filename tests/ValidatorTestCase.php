<?php

abstract class ValidatorTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app->register(\geekcom\ValidatorDocs\ValidatorProvider::class);
    }
}