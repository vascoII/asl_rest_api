<?php

namespace Fds\AslBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AslControllerTest extends WebTestCase
{
    public function testGetallasls()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/asls');
    }

    public function testGetoneasl()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/asl/{max}');
    }

    public function testGetasls()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'asls');
    }

}
