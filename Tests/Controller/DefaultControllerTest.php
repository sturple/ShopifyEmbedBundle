<?php

namespace Fgms\ShopifyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'http://www.peetzoutdoors.com/apps/fgms/contest/test/');

        $this->assertTrue($crawler->filter('html:contains("contest")')->count() > 0);
    }
}
