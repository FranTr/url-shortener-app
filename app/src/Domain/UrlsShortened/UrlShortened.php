<?php

namespace App\Domain\UrlsShortened;

class UrlShortened
{
    private $code;
    private $url;
    private $redirections;
    private $isDeleted;

    public function __construct(String $code, String $url, int $redirections, bool  $isDeleted)
    {
        $this->code = $code;
        $this->url = $url;
        $this->redirections = $redirections;
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return String
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param String $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return String
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param String $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getRedirections(): int
    {
        return $this->redirections;
    }

    /**
     * @param int $redirections
     */
    public function setRedirections(int $redirections): void
    {
        $this->redirections = $redirections;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }
}