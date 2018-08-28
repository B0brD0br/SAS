<?php

namespace SAS\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CallDetailsInsertControllerTest extends WebTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testSuccessfulInsertDataReturnsCreatedStatusCode()
    {
        $this->client->request(
            'POST',
            'api/insert/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "appName": "someApp",
                "apiName": "someApi",
                "endpointName": "someEndpoint",
                "success": true,
                "timeStamp": "2018-04-05 12:24:53",
                "duration": 200,
                "statusCode": "200 - OK"
            }'
        );

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testContentNotEmptyWhenInsertingData()
    {
        $this->client->request(
            'POST',
            'api/insert/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "appName": "someApp",
                "apiName": "someApi",
                "endpointName": "someEndpoint",
                "success": true,
                "timeStamp": "2018-04-05 12:24:53",
                "duration": 200,
                "statusCode": "200 - OK"
            }'
        );

        $this->assertNotEmpty(json_decode($this->client->getResponse()->getContent()));
    }

    public function testErrorIsReceivedIfWrongDataSent()
    {
        $this->client->request(
            'POST',
            'api/insert/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "appName": "",
                "apiName": "someApi",
                "endpointName": "someEndpoint",
                "success": true,
                "timeStamp": "2018-04-05 12:24:53",
                "duration": 200,
                "statusCode": "200 - OK"
            }'
        );

        $expectation = json_encode('appName should not be blank');

        $this->assertEquals($expectation, $this->client->getResponse()->getContent());
    }
}
