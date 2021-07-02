<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

class ConnectionPageTest extends WebTestCase {

    public function testConnectionPage() {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testRegistrationPage() {
        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

}