<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AirplanePlaceRepository")
 */
class AirplanePlace
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airplane", inversedBy="airplanePlaces")
     */
    private $airplane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlaceCategory", inversedBy="airplanePlaces")
     */
    private $placeCategory;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAirplane(): ?Airplane
    {
        return $this->airplane;
    }

    public function setAirplane(?Airplane $airplane): self
    {
        $this->airplane = $airplane;

        return $this;
    }

    public function getPlaceCategory(): ?PlaceCategory
    {
        return $this->placeCategory;
    }

    public function setPlaceCategory(?PlaceCategory $placeCategory): self
    {
        $this->placeCategory = $placeCategory;

        return $this;
    }
}
