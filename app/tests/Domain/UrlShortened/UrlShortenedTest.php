<?php

namespace App\Tests\Domain\UrlShortened;

use App\Domain\UrlsShortened\UrlShortened;
use PHPUnit\Framework\TestCase;

class UrlShortenedTest extends TestCase
{

    public function testUrlShortened()
    {
        $urlShortened = new UrlShortened("1234", "www.google.com", 0, false);
        $this->assertEquals("1234", $urlShortened->getCode());
        $this->assertEquals("www.google.com", $urlShortened->getUrl());
        $this->assertEquals(0, $urlShortened->getRedirections());
    }
}