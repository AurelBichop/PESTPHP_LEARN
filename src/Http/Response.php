<?php

namespace App\Http;
class Response{
    /**
     * @param string $body
     * @param int $statusCode
     * @param iterable $headers
     */
    public function __construct(
        private string $body = '',
        private int $statusCode = 200,
        private iterable $headers = []
    )
    {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

}