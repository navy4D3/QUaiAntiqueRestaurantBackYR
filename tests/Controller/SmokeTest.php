<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    public function testApiDocUrlIsSuccessful(): void
    {
        $client = self::createClient();
        $client->followRedirects(false);
        $client->request('GET', '/api/doc');
        self::assertResponseIsSuccessful();
    }

    public function testApiAccountUrlIsSecure(): void
    {
        $client = self::createClient();
        $client->followRedirects(false);
        $client->request('GET', '/api/restaurant/{id}');
        self::assertResponseStatusCodeSame(401);
    }

    // public function testLoginRouteCanConnectAValidUser(): void
    // {
    //     $client = self::createClient();
    //     $client->request('POST', '/api/login');
    //     self::assertResponseStatusCodeSame(401);
    // }
}