<?php 

namespace SAS\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FieldValidation 
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var Assert\Collection
     */
    private $constraint;

    public function __construct()
    {
        $this->validator = Validation::createValidator();

        $this->constraint = new Assert\Collection(
            [
                'fields' => 
                [
                    'appName' => 
                    [
                        new Assert\Type(
                            [
                                'type' => 'string',
                                'message' => 'appName should be of type string'
                            ]
                        ),
                        new Assert\NotBlank(
                            [
                                'message' => 'appName should not be blank'
                            ]
                        )
                    ],
                    'apiName' =>
                    [
                        new Assert\Type(
                            [
                                'type' => 'string',
                                'message' => 'apiName should be of type string'
                            ]
                        ),
                        new Assert\NotBlank(
                            [
                                'message' => 'apiName should not be blank'
                            ]
                        )
                    ],
                    'endpointName' =>
                    [
                        new Assert\Type(
                            [
                                'type' => 'string',
                                'message' => 'endpointName should be of type string'
                            ]
                        ),
                        new Assert\NotBlank(
                            [
                                'message' => 'endpointName should not be blank'
                            ]
                        )
                    ],
                    'success' => 
                    [
                        new Assert\Type(
                            [
                                'type' => 'bool',
                                'message' => 'success should be of type boolean'
                            ]
                        ),
                        new Assert\NotBlank(
                            [
                                'message' => 'success should not be blank'
                            ]
                        )
                    ],
                    'timeStamp' => 
                    [
                        new Assert\DateTime(
                            [
                                'message' => 'timeStamp should be in Y-m-d H:i:s format'
                            ]
                        ),
                        new Assert\NotBlank(
                            [
                                'message' => 'timeStamp should not be blank'
                            ]
                        )
                    ],
                    'duration' => new Assert\Optional(
                    [
                        new Assert\Type(
                            [
                                'type' => 'integer',
                                'message' => 'duration should be of type integer'
                            ]
                        )
                    ]),
                    'statusCode' => new Assert\Optional(
                        [
                        new Assert\Type(
                            [
                                'type' => 'string',
                                'message' => 'statusCode should be of type string'
                            ]
                        )]
                    )
                ],
                'missingFieldsMessage' => '{{ field }} field is missing'
            ]
        );
    }

    public Function validateFields(array $data)
    {
        $violations = $this->validator->validate($data, $this->constraint);

        $returnErrors = [];
        foreach ($violations as $error) {
            $returnErrors[] = $error->getMessage();
        }
        return $returnErrors;
    }
}
