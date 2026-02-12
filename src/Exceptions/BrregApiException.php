<?php

namespace Tor2r\BrregApi\Exceptions;

use Exception;

class BrregApiException extends Exception
{
    public static function notFound(string $orgnr): static
    {
        return new static("No entity found with organisation number: {$orgnr}");
    }

    public static function requestFailed(int $status, string $body): static
    {
        return new static("Brreg API request failed with status {$status}: {$body}");
    }
}
