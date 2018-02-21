<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegerControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateModel()
    {
        $response = $this->call('POST', '/integer/create', ['number' => 5]);
        $this->assertEquals(200, $response->status());
        $response = $this->call('POST', '/integer/create', ['number' => 0]);
        $this->assertEquals(400, $response->status());
        $response = $this->call('POST', '/integer/create', ['number' => 4000]);
        $this->assertEquals(400, $response->status());
        $response = $this->call('POST', '/integer/create');
        $this->assertEquals(400, $response->status());
    }

    public function testList()
    {
        $response = $this->call('GET', '/integer/list');
        $this->assertEquals(200, $response->status());
    }

    public function testTopConverted()
    {
        $response = $this->call('GET', '/integer/top-converted');
        $this->assertEquals(200, $response->status());
    }

}
