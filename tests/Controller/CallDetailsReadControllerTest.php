<?php

namespace SAS\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CallDetailsReadControllerTest extends WebTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testShowOKIfNoGuidIsPassedInGET()
    {
        $this->client->request('GET', 'api/show/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testResponseContentNotEmptyWhenNoGuidIsPassedInGET()
    {
        $this->client->request('GET', 'api/show/');

        $responseContent = json_decode($this->client->getResponse()->getContent());

        $this->assertNotEmpty($responseContent);
    }

    public function testShowOKIfCorrectGuidIsPassedInGET()
    {
        $this->client->request('GET', 'api/show/?guid=68d0b8bb-3129-4998-91b1-2e95d18ab779');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowResponseContentIfGuidIsPassed()
    {
        $this->client->request('GET', 'api/show/?guid=68d0b8bb-3129-4998-91b1-2e95d18ab779');

        $expectation = '{"id":201,"guid":"68d0b8bb-3129-4998-91b1-2e95d18ab779","appname":"someApp",';
        $expectation .= '"apiname":"someApi","endpointname":"someEndpoint","success":true,';
        $expectation .= '"timestamp":"2018-04-05 12:24:53","duration":200,"statuscode":"200 - OK"}';

        $this->assertEquals($expectation, $this->client->getResponse()->getContent());
    }

    public function testShowBadRequestIfGuidIsWrongInGET()
    {
        $this->client->request('GET', 'api/show/?guid=68d0b8');

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testShowNoDataIfWrongGUIDInGET()
    {
        $this->client->request('GET', 'api/show/?guid=123123');

        $expectation = json_encode('No data with provided guid');

        $this->assertEquals($expectation, $this->client->getResponse()->getContent());
    }
}
