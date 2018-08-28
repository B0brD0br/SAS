<?php

namespace SAS\DataTransformation;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class TimeNormalization
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new DateTimeNormalizer()]);
    }

    public function denormalizeTime(string $time): \DateTime
    {
        return $this->serializer->denormalize($time, \DateTime::class);
    }
}
