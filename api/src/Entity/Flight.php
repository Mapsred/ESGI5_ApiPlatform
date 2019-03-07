<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Validator\Constraints\AvailableFlightDateRange;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"flight_read"}},
 *     denormalizationContext={"groups"={"flight_write"}},
 *     itemOperations={"get", "delete"}
 * )
 * @ApiFilter(DateFilter::class, properties={"arrivalDate", "departureDate"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "departure": "ipartial",
 *     "destination": "ipartial",
 *     "airplane": "exact",
 *     "airplane.airplaneModel": "exact",
 * })
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 * @AvailableFlightDateRange
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
     * @Groups({"flight_write", "flight_read"})
     */
    private $departure;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"flight_write", "flight_read"})
     */
    private $destination;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"flight_write", "flight_read"})
     */
    private $arrivalDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airplane", inversedBy="flights")
     * @Groups({"flight_write", "flight_read"})
     */
    private $airplane;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AirplanePlace", mappedBy="flight")
     * @Groups({"flight_read"})
     */
    private $airplanePlaces;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"flight_write", "flight_read"})
     */
    private $departureDate;

    /**
     * Flight constructor.
     */
    public function __construct()
    {
        $this->airplanePlaces = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    /**
     * @param string $departure
     * @return Flight
     */
    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     * @return Flight
     */
    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrivalDate;
    }

    /**
     * @param \DateTime $arrivalDate
     * @return Flight
     */
    public function setArrivalDate(\DateTime $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * @return Airplane|null
     */
    public function getAirplane(): ?Airplane
    {
        return $this->airplane;
    }

    /**
     * @param Airplane|null $airplane
     * @return Flight
     */
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

    /**
     * @param AirplanePlace $airplanePlace
     * @return Flight
     */
    public function addAirplanePlace(AirplanePlace $airplanePlace): self
    {
        if (!$this->airplanePlaces->contains($airplanePlace)) {
            $this->airplanePlaces[] = $airplanePlace;
            $airplanePlace->setFlight($this);
        }

        return $this;
    }

    /**
     * @param AirplanePlace $airplanePlace
     * @return Flight
     */
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

    /**
     * @return \DateTime|null
     */
    public function getDepartureDate(): ?\DateTime
    {
        return $this->departureDate;
    }

    /**
     * @param \DateTime $departureDate
     * @return Flight
     */
    public function setDepartureDate(\DateTime $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }
}
