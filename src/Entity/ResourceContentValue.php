<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResourceContentValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResourceContentValueRepository::class)
 * @ApiResource
 */
class ResourceContentValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stringValue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textValue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $imageValue;

    /**
     * @ORM\ManyToOne(targetEntity=Resource::class, inversedBy="content")
     */
    private $resource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStringValue(): ?string
    {
        return $this->stringValue;
    }

    public function setStringValue(string $stringValue): self
    {
        $this->stringValue = $stringValue;

        return $this;
    }

    public function getTextValue(): ?string
    {
        return $this->textValue;
    }

    public function setTextValue(?string $textValue): self
    {
        $this->textValue = $textValue;

        return $this;
    }

    public function getImageValue(): ?string
    {
        return $this->imageValue;
    }

    public function setImageValue(?string $imageValue): self
    {
        $this->imageValue = $imageValue;

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }
}