<?php

namespace App\Tests\Application\UrlShortened\Delete;

use App\Application\UrlShortened\Delete\DeleteUrlShortened;
use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class DeleteUrlShortenedTest extends TestCase
{

    public function testDelete()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(false);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);

        $urlShortenedRepositoryMock->method("findUrlShortenedByCode")->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->once())->method("saveUrlShortened");

        $deleteUrlShortened = new DeleteUrlShortened($urlShortenedRepositoryMock);
        $deleteUrlShortened->delete("1234");
    }

    public function testReadWithNotFoundException()
    {

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn(null);
        $urlShortenedRepositoryMock->expects($this->never())->method('saveUrlShortened');

        $readUrlShortened = new DeleteUrlShortened($urlShortenedRepositoryMock);

        $this->expectException(NotFoundResourceException::class);
        $this->expectExceptionMessage("not found");
        $readUrlShortened->delete("1234");
    }

    public function testReadWithInvalidadArgumentException()
    {
        $urlShortenedMock = $this->createMock(UrlShortened::class);
        $urlShortenedMock->method("getRedirections")->willReturn(0);
        $urlShortenedMock->method("isDeleted")->willReturn(true);

        $urlShortenedRepositoryMock = $this->createMock(UrlShortenedRepository::class);
        $urlShortenedRepositoryMock->method('findUrlShortenedByCode')->willReturn($urlShortenedMock);
        $urlShortenedRepositoryMock->expects($this->never())->method('saveUrlShortened');

        $readUrlShortened = new DeleteUrlShortened($urlShortenedRepositoryMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("shortened url already deleted");
        $readUrlShortened->delete("1234");
    }


}