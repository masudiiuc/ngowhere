<?php

namespace ProjectBundle\Bundle\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');

        $this->assertTrue($crawler->filter('html:contains("About ProjectBundle BD!")')->count() > 0);
    }
}
