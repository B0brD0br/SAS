<?php

namespace SAS\Entity;

use SAS\DataTransformation\TimeNormalization;
use Doctrine\ORM\Mapping as ORM;

/**
 * Calldetails
 *
 * @ORM\Table(name="callDetails")
 * @ORM\Entity
 */
class Calldetails
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=255, nullable=false)
     */
    private $guid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="appName", type="string", length=255, nullable=false)
     */
    private $appname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="apiName", type="string", length=255, nullable=false)
     */
    private $apiname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="endpointName", type="string", length=255, nullable=false)
     */
    private $endpointname = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="success", type="boolean", nullable=true)
     */
    private $success;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeStamp", type="datetime", nullable=true)
     */
    private $timestamp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="statusCode", type="string", length=255, nullable=true)
     */
    private $statuscode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getAppname(): ?string
    {
        return $this->appname;
    }

    public function setAppname(string $appname): self
    {
        $this->appname = $appname;

        return $this;
    }

    public function getApiname(): ?string
    {
        return $this->apiname;
    }

    public function setApiname(string $apiname): self
    {
        $this->apiname = $apiname;

        return $this;
    }

    public function getEndpointname(): ?string
    {
        return $this->endpointname;
    }

    public function setEndpointname(string $endpointname): self
    {
        $this->endpointname = $endpointname;

        return $this;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(?bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp->format('Y-m-d H:i:s');
    }

    public function setTimestamp(?string $timestamp): self
    {
        $timeNormalizer = new TimeNormalization;
        $this->timestamp = $timeNormalizer->denormalizeTime($timestamp);

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getStatuscode(): ?string
    {
        return $this->statuscode;
    }

    public function setStatuscode(?string $statuscode): self
    {
        $this->statuscode = $statuscode;

        return $this;
    }
}
