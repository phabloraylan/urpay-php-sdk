<?php
namespace Tests;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        
        $this->assertEquals("testing",\getenv('TOKEN_COMUM'));
    }
}