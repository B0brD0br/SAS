<?php

namespace SAS\Services;

use SAS\Entity\Calldetails;
use SAS\DataTransformation\DataSerialization;
use SAS\Validator\DataValidation;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class CallDetailsInsert
{
    /**
     * @var Uuid
     */
    private $uuid4;

    /**
     * @var DateNormalization
     */
    private $normalization;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(DataSerialization $deserialization, EntityManagerInterface $entityManager)
    {
        $this->deserialization = $deserialization;
        $this->entityManager = $entityManager;
        $this->uuid4 = Uuid::uuid4();
    }

    public function insertCallDetails(string $data): string
    {
        $callDetails = $this->deserialization->deserializeData($data);
        $callDetails->setGuid($this->uuid4->toString());

        $this->entityManager->persist($callDetails);
        $this->entityManager->flush();

        return json_encode($callDetails->getGuid());
    }
}
