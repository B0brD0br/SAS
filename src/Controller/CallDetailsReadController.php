<?php

namespace SAS\Controller;

use SAS\Services\Result;
use SAS\Services\CallDetailsRead;
use SAS\Validator\FieldValidation;
use SAS\Exceptions\DataValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CallDetailsReadController
{
    /**
     * @param Result $result
     */
    private $result;

    /**
     * @var string
     */
    private const GUID_FIELD_NAME = 'guid';

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function readData(CallDetailsRead $service, Request $request): Response
    {
        try {
            $data = $service->readCallDetails($request->query->get(self::GUID_FIELD_NAME));
        } catch (DataValidationException $e) {
            return $this->result->createResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
 
        return $this->result->createResponse($data, Response::HTTP_OK);
    }
}
