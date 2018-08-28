<?php

namespace SAS\Tests\DataTransformation;

use SAS\DataTransformation\DataSerialization;
use SAS\Entity\Calldetails;
use PHPUnit\Framework\TestCase;

class DataSerializationTest extends TestCase
{
    public function testIfReturningAStringFromCallDetailsObj()
    {
        $data = new Calldetails;
        $serializer = new DataSerialization;

        $data->setGuid('someGuid');
        $data->setAppname('someApp');
        $data->setApiname('someApi');
        $data->setEndpointname('someEndpoint');
        $data->setTimestamp('2018-04-05 12:24:53');
        $data->setSuccess(true);
        $data->setDuration(200);
        $data->setStatuscode('200 - OK');

        $expectation = '{"id":null,"guid":"someGuid","appname":"someApp","apiname":"someApi","endpointname":"someEndpoint","success":true,"timestamp":"2018-04-05 12:24:53","duration":200,"statuscode":"200 - OK"}';
        $data = $serializer->serializeData($data);

        $this->assertEquals($expectation, $data);
    }

    public function testIfReturningAnInstanceOfCalldetailObj()
    {
        $serializer = new DataSerialization;

        $data = '{"id":"5","guid":"someGuid","appname":"someApp","apiname":"someApi","endpointname":"someEndpoint","success":true,"timestamp":"2018-04-05 12:24:53","duration":200,"statuscode":"200 - OK"}';
        $data = $serializer->deserializeData($data);

        $this->assertInstanceOf(Calldetails::class, $data);
    }
}
