<?php

namespace SAS\Services;

use Symfony\Component\HttpFoundation\Response;

interface Result
{
    public function createResponse($data, int $statusCode): Response;
}
