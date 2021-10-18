<?php

namespace App\Tests\Application\UrlShortened\Create;

use App\Application\UrlShortened\Create\CreateUrlShortened;
use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CreateUrlShortenedTest extends TestCase
{
    public function testCreateAlreadyCreatedUrl()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(false);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);

        $urlShortenedRepositoryMock->method("findUrlShortenedByCode")->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->once())->method("saveUrlShortened");

        $deleteUrlShortened = new CreateUrlShortened($urlShortenedRepositoryMock);
        $deleteUrlShortened->create("wwww.google.es");
    }
    public function testCreateNewUrl()
    {

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn(null);
        $urlShortenedRepositoryMock->expects($this->once())->method('saveUrlShortened');

        $readUrlShortened = new CreateUrlShortened($urlShortenedRepositoryMock);

        $readUrlShortened->create("1234");
    }

    public function testReadWithInvalidadArgumentException()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(true);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByUrl')->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->once())->method('saveUrlShortened');
        $urlShortenedMock->expects($this->once())->method("setIsDeleted");

        $readUrlShortened = new CreateUrlShortened($urlShortenedRepositoryMock);
        $readUrlShortened->create("1234");
    }
}