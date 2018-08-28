<?php

namespace SAS\Tests\Services;

use SAS\Entity\Calldetails;
use SAS\Services\CallDetailsInsert;
use SAS\DataTransformation\DataSerialization;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CallDetailsInsertTest extends TestCase
{
    private $entityManager;
    
    private $deserializer;

    protected function setUp()
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->deserializer = new DataSerialization;
    }

    public function testReturnValidGuidWhenSubmittingData()
    {
        $callDetailsInsert = new CallDetailsInsert($this->deserializer, $this->entityManager);
        
        $data = '{
            "appName": "someApp",
            "apiName": "someApi",
            "endpointName": "someEndpoint",
            "success": true,
            "timeStamp": "2018-04-05 12:24:53",
            "duration": 200,
            "statusCode": "200 - OK"
        }';

        $this->assertTrue(Uuid::isValid(json_decode($callDetailsInsert->insertCallDetails($data))));
    }
}
