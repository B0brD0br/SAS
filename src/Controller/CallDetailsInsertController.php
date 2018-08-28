<?php

namespace SAS\Controller;

use SAS\Services\Result;
use SAS\Services\CallDetailsInsert;
use SAS\Validator\FieldValidation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CallDetailsInsertController
{
    /**
     * @param Result $result
     */
    private $result;

    /**
     * @var FieldValidation
     */
    private $validator;

    public function __construct(Result $result, FieldValidation $validator)
    {
        $this->result = $result;
        $this->validator = $validator; 
    }

    public function insertData(CallDetailsInsert $service, Request $request): Response
    {
        $errors = $this->validator->validateFields(json_decode($request->getContent(), true));

        if (!empty($errors)) {
            $data = json_encode(implode('. ', $errors));
            
            return $this->result->createResponse($data, Response::HTTP_BAD_REQUEST);
        }

        $data = $service->insertCallDetails($request->getContent());
        return $this->result->createResponse($data, Response::HTTP_CREATED);
    }
}
