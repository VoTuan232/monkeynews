<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /* executed by PHPUNIT before each tet */
    public function setUp() {
    	parent::setUp();
    	// $this->prepareForTests();
    }

    public function singIn($user = null) {
    	$user = $user ? : create(User::class);
    	$this->actingAs($user);

    	return $this;
    }

    // public function prepareForTests() 
    // {
    // 	Artisan::call('migrate');
    // 	Mail::pretend(true);
    // }

    // public function createApplication() {
    // 	$unitTesting = true;
    // 	$testEnvironment = 'testing';

    // 	return require __DIR__.'/../../start.php';
    // }
}
