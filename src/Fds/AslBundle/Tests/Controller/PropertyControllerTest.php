<?php

namespace Fds\AslBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PropertyControllerTest extends WebTestCase
{
    public function testGetproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getProperties');
    }

    public function testGetproperty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getProperty');
    }

    public function testDeleteproperty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteProperty');
    }

    public function testPostproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postProperties');
    }

    public function testPutproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/putProperties');
    }

    public function testPatchproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/patchProperties');
    }

}
