<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ApiForbiddenException extends ApiException
{
    public function __construct(string $message = null)
    {
        parent::__construct(self::PERMISSION_ERROR, $message ?? Response::$statusTexts[self::PERMISSION_ERROR]);
    }
}
