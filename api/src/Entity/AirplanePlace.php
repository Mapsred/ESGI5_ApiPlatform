<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", cascade={"persist", "remove"}, inversedBy="airplanePlaces")
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlaceCategory", cascade={"persist", "remove"}, inversedBy="airplanePlaces")
     */
    private $placeCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ticket", cascade={"persist", "remove"}, inversedBy="airplanePlace")
     */
    private $ticket;

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

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

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

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }
}
