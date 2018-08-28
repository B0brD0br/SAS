<?php

namespace SAS\DataTransformation;

use SAS\Entity\Calldetails;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DataSerialization
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @param Calldetails|array $data
     */
    public function serializeData($data): string
    {
        return $this->serializer->serialize($data, 'json');
    }    

    public function deserializeData(string $data): Calldetails
    {
        return $this->serializer->deserialize($data, Calldetails::class ,'json');
    }
}
