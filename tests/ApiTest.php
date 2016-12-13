<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testInvalidObjectApiMethod()
    {
        $response = $this->call('GET', 'api/v1/object');

        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testNotExistObjectKeyValue()
    {
        $response = $this->call('GET', 'api/v1/object/doesnotexits');

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testExistObjectKeyValue()
    {
        $response = $this->call('GET', 'api/v1/object/mykey');

        $this->assertEquals(200, $response->getStatusCode());
    }

}
