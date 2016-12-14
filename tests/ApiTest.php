<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'testing']);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testInvalidObjectApiMethod()
    {
        $this->json('GET', 'api/v1/object')
             ->assertResponseStatus(405);
    }

    public function testNonExistObjectKeyValue()
    {
        $this->json('GET', 'api/v1/object/doesnotexits')
             ->assertResponseStatus(404);
    }

    public function testExistObjectKeyValue()
    {
        $this->json('GET', '/api/v1/object/key1')
             ->seeJson([
                 'status_code' => 200
             ])
             ->assertResponseStatus(200);
    }

    public function testSubmitObjectValueSuccessfully()
    {
        $this->json('POST', '/api/v1/object', ['key10' => 'value10'])
             ->seeJson([
                 'status_code' => 201
             ])
             ->assertResponseStatus(201);
    }

    public function testSubmitEmptyObjectValue()
    {
        $this->json('POST', '/api/v1/object', [''])
             ->seeJson([
                 'status_code' => 400,
                 'message'     => 'Your value is empty.'
             ])
             ->assertResponseStatus(400);
    }

}
