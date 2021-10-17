<?php

namespace App\Infrastructure\Repository\UrlShortened;

use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineUrlShortenedRepository extends ServiceEntityRepository implements UrlShortenedRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlShortened::class);
    }

    public function saveUrlShortened(UrlShortened $urlShortened): void
    {
        $this->_em->persist($urlShortened);
        $this->_em->flush();
    }

    public function findUrlShortenedByCode(string $code): ?UrlShortened
    {
       return $this->findOneBy(['code' => $code]);

    }
    public function findUrlShortenedByUrl(string $url): ?UrlShortened
    {
       return $this->findOneBy(['url' => $url]);

    }
}