<?php

namespace Fds\AslBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PropertyControllerTest extends WebTestCase
{
    public function testGetproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'get_properties');
    }

    public function testPostproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post_properties');
    }

}
