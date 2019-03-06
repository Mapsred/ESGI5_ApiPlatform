<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
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
    private $departure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrival_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airplane", inversedBy="flights")
     */
    private $airplane;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirplanePlace", mappedBy="flight")
     */
    private $airplanePlaces;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departure_date;

    public function __construct()
    {
        $this->airplanePlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTime $arrival_date): self
    {
        $this->arrival_date = $arrival_date;

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

    /**
     * @return Collection|AirplanePlace[]
     */
    public function getAirplanePlaces(): Collection
    {
        return $this->airplanePlaces;
    }

    public function addAirplanePlace(AirplanePlace $airplanePlace): self
    {
        if (!$this->airplanePlaces->contains($airplanePlace)) {
            $this->airplanePlaces[] = $airplanePlace;
            $airplanePlace->setFlight($this);
        }

        return $this;
    }

    public function removeAirplanePlace(AirplanePlace $airplanePlace): self
    {
        if ($this->airplanePlaces->contains($airplanePlace)) {
            $this->airplanePlaces->removeElement($airplanePlace);
            // set the owning side to null (unless already changed)
            if ($airplanePlace->getFlight() === $this) {
                $airplanePlace->setFlight(null);
            }
        }

        return $this;
    }

    public function getDepartureDate(): ?\DateTime
    {
        return $this->departure_date;
    }

    public function setDepartureDate(\DateTime $departure_date): self
    {
        $this->departure_date = $departure_date;

        return $this;
    }

}
