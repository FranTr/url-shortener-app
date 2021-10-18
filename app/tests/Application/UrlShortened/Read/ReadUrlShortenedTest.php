<?php

namespace App\Tests\Application\UrlShortened\Read;

use App\Application\UrlShortened\Read\ReadUrlShortened;
use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ReadUrlShortenedTest extends TestCase
{

    public function testRead()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(false);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->once())->method('saveUrlShortened');

        $readUrlShortened = new ReadUrlShortened($urlShortenedRepositoryMock);
        $readUrlShortened->read("1234");

    }

    public function testReadWithNotFoundException()
    {

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn(null);
        $urlShortenedRepositoryMock->expects($this->never())->method('saveUrlShortened');

        $readUrlShortened = new ReadUrlShortened($urlShortenedRepositoryMock);

        $this->expectException(NotFoundResourceException::class);
        $this->expectExceptionMessage("not found");
        $readUrlShortened->read("1234");
    }

    public function testReadWithInvalidadArgumentException()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(true);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->never())->method('saveUrlShortened');

        $readUrlShortened = new ReadUrlShortened($urlShortenedRepositoryMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("that url has been deleted");
        $readUrlShortened->read("1234");
    }
}