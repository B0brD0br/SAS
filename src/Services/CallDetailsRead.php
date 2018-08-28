<?php 

namespace SAS\Services;

use SAS\DataTransformation\DataSerialization;
use SAS\Entity\Calldetails;
use SAS\Exceptions\DataValidationException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CallDetailsRead
{
    /**
     * @var DataSerialization
     */
    private $serialization;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(DataSerialization $serialization, EntityManagerInterface $entityManager)
    {
        $this->serialization = $serialization;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws DataValidationException if provided guid doesn't exist
     */
    public function readCallDetails(string $guid = null): string
    {
        if ($guid) {
            $callDetail = $this->entityManager
                ->getRepository(Calldetails::class)
                ->findOneBy(['guid' => $guid]);
            if($callDetail) {
                return $this->serialization->serializeData($callDetail); 
            }
            
            throw new DataValidationException(json_encode('No data with provided guid'));
        }

        $callDetail = $this->entityManager
            ->getRepository(Calldetails::class)
            ->findAll();

        return $this->serialization->serializeData(['callDetails' => $callDetail]);
    }
}
