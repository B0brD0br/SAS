<?php

namespace SAS\Tests\Services;

use SAS\Entity\Calldetails;
use SAS\Services\CallDetailsRead;
use SAS\DataTransformation\DataSerialization;
use SAS\Exceptions\DataValidationException;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class CallDetailsReadTest extends TestCase
{
    private $callDetailsRepository;
    private $entityManager;

    protected function setUp()
    {
        $this->callDetailsRepository = $this->createMock(EntityRepository::class);

        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->callDetailsRepository);
    }

    public function testIfNoGuidIsPassedReturnAllRecords()
    {
        $data = [['id' => 1],['id' => 2]];
        $expectedResult = '{"callDetails":[{"id":1},{"id":2}]}';

        $this->callDetailsRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($data);

        $serialization = new DataSerialization;

        $callDetailsRead = new CallDetailsRead($serialization, $this->entityManager);

        $this->assertEquals($expectedResult, $callDetailsRead->readCallDetails());
    }

    public function testIfExistingGuidIsPassedReturnSingleRecord()
    {
        $data = [['id' => 1]];
        $guid = 1;
        $expectedResult = '[{"id":1}]';

        $this->callDetailsRepository->expects($this->any())
            ->method('findOneBy')
            ->with(['guid' => $guid]) 
            ->willReturn($data);

        $serialization = new DataSerialization;

        $callDetailsRead = new CallDetailsRead($serialization, $this->entityManager);

        $this->assertEquals($expectedResult, $callDetailsRead->readCallDetails($guid));
    }

    public function testIfNonExistingGuidIsPassedThrowException()
    {
        $data = null;
        $guid = 1;

        $this->callDetailsRepository->expects($this->any())
            ->method('findOneBy')
            ->with(['guid' => $guid])
            ->willReturn($data);

        $serialization = new DataSerialization;

        $this->expectException(DataValidationException::class);

        $callDetailsRead = new CallDetailsRead($serialization, $this->entityManager);
        $result = $callDetailsRead->readCallDetails($guid);
    }
}
