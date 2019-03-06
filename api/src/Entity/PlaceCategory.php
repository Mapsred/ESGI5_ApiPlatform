<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaceCategoryRepository")
 */
class PlaceCategory
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
     * @ORM\Column(type="integer")
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AirplanePlace", inversedBy="placeCategory")
     */
    private $airplanePlace;

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

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getAirplanePlace(): ?AirplanePlace
    {
        return $this->airplanePlace;
    }

    public function setAirplanePlace(?AirplanePlace $airplanePlace): self
    {
        $this->airplanePlace = $airplanePlace;

        return $this;
    }
}
