<?php

namespace SAS\Services;

use Symfony\Component\HttpFoundation\Response;

class JsonResult implements Result
{
    /**
     * @param array|string $data
     */
    public function createResponse($data, int $statusCode): Response
    {
        return new Response(
            $data,
            $statusCode,
            ['Content-type' => 'application/json']
        );
    }
}
