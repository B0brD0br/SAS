<?php

namespace SAS\Tests\Validator;

use SAS\Validator\FieldValidation;
use PHPUnit\Framework\TestCase;

class FieldValidationTest extends TestCase 
{
    public $validationTest;

    protected function setUp()
    {   
        $this->validationTest = new FieldValidation;
    }

    /**
     * @dataProvider correctProvider
     */
    public function testEmptyArrayIfAllDataIsCorrect($submittedData, $expected)
    {
        $data = $this->validationTest->validateFields($submittedData);
        $this->assertEquals($expected, $data);
    }

    /**
     * @dataProvider fieldProvider
     */
    public function testOutputErrorsIfFieldsAreNotPresent($submittedData, $expected)
    {
        $data = $this->validationTest->validateFields($submittedData);
        $this->assertEquals($expected, $data);
    }

    /**
     * @dataProvider emptyProvider
     */
    public function testOutputErrorsIfFieldsAreEmpty($submittedData, $expected)
    {
        $data = $this->validationTest->validateFields($submittedData);
        $this->assertEquals($expected, $data);
    }

    /**
     * @dataProvider typeProvider
     */
    public function testOutputErrorsIfWrongDataType($submittedData, $expected)
    {
        $data = $this->validationTest->validateFields($submittedData);
        $this->assertEquals($expected, $data);
    }

    public function correctProvider()
    {
        return [    
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                []
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                ], 
                []
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                ], 
                []
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'statusCode' => '200 - OK'
                ], 
                []
            ]
        ];
    }
    
    public function fieldProvider()
    {
        return [    
            [
                [
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['"appName" field is missing']
            ],
            [
                [
                    'appName' => 'someApp',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['"apiName" field is missing']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['"endpointName" field is missing']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['"timeStamp" field is missing']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['"success" field is missing']
            ]
        ];
    }

    public function emptyProvider()
    {
        return [    
            [
                [
                    'appName' => '',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['appName should not be blank']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => '',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['apiName should not be blank']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => '',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['endpointName should not be blank']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['timeStamp should not be blank']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => null,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['success should not be blank']
            ]
        ];
    }

    public function typeProvider()
    {
        return [    
            [
                [
                    'appName' => 22,
                    'apiName' => 'someApi',
                    'endpointName' => 'someEndpoint',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['appName should be of type string']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 22,
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['apiName should be of type string']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 22,
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['endpointName should be of type string']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['timeStamp should be in Y-m-d H:i:s format']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => "true",
                    'duration' => 2000,
                    'statusCode' => '200 - OK'
                ], 
                ['success should be of type boolean']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => "2000",
                    'statusCode' => '200 - OK'
                ], 
                ['duration should be of type integer']
            ],
            [
                [
                    'appName' => 'someApp',
                    'apiName' => 'someApi',
                    'endpointName' => 'endpointName',
                    'timeStamp' => '2018-04-17 12:04:37',
                    'success' => true,
                    'duration' => 2000,
                    'statusCode' => 200
                ], 
                ['statusCode should be of type string']
            ]
        ];
    }
}
