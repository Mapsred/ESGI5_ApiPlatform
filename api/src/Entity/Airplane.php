<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"airplane_read"}},
 *     denormalizationContext={"groups"={"airplane_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PlaneRepository")
 */
class Airplane
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="airplanes")
     * @Assert\NotNull()
     * @Groups({"airplane_write", "airplane_read"})
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Staff", mappedBy="airplane")
     * @Groups({"airplane_read"})
     */
    private $staff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="airplanes")
     * @Groups({"airplane_write", "airplane_read"})
     * @Assert\NotNull()
     */
    private $airport;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pilot", cascade={"persist", "remove"}, inversedBy="plane")
     * @Groups({"airplane_read"})
     */
    private $pilot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="airplane")
     * @Groups({"airplane_read"})
     */
    private $flights;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AirplaneModel", inversedBy="airplanes")
     * @Groups({"airplane_write", "airplane_read"})
     * @Assert\NotNull()
     */
    private $airplaneModel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AirStrip", mappedBy="airplane", cascade={"persist", "remove"})
     * @Groups({"airplane_read"})
     * @Assert\NotNull(message="No Airstrip available in this Airport")
     */
    private $airstrip;

    /**
     * Airplane constructor.
     */
    public function __construct()
    {
        $this->staff = new ArrayCollection();
        $this->flights = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     * @return Airplane
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    /**
     * @param Staff $staff
     * @return Airplane
     */
    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
            $staff->setAirplane($this);
        }

        return $this;
    }

    /**
     * @param Staff $staff
     * @return Airplane
     */
    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->contains($staff)) {
            $this->staff->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getAirplane() === $this) {
                $staff->setAirplane(null);
            }
        }

        return $this;
    }

    /**
     * @return Airport|null
     */
    public function getAirport(): ?Airport
    {
        return $this->airport;
    }

    /**
     * @param Airport|null $airport
     * @return Airplane
     */
    public function setAirport(?Airport $airport): self
    {
        $this->airport = $airport;

        return $this;
    }

    /**
     * @return Pilot
     */
    public function getPilot():? Pilot
    {
        return $this->pilot;
    }

    /**
     * @param Pilot $pilot
     * @return Airplane
     */
    public function setPilot(?Pilot $pilot): Airplane
    {
        $this->pilot = $pilot;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights[] = $flight;
            $flight->setAirplane($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->contains($flight)) {
            $this->flights->removeElement($flight);
            // set the owning side to null (unless already changed)
            if ($flight->getAirplane() === $this) {
                $flight->setAirplane(null);
            }
        }

        return $this;
    }

    public function getAirplaneModel(): ?AirplaneModel
    {
        return $this->airplaneModel;
    }

    public function setAirplaneModel(?AirplaneModel $airplaneModel): self
    {
        $this->airplaneModel = $airplaneModel;

        return $this;
    }

    public function getAirstrip(): ?AirStrip
    {
        return $this->airstrip;
    }

    public function setAirstrip(?AirStrip $airstrip): self
    {
        $this->airstrip = $airstrip;

        // set (or unset) the owning side of the relation if necessary
        $newAirplane = $airstrip === null ? null: $this;
        if ($newAirplane !== $airstrip->getAirplane()) {
            $airstrip->setAirplane($newAirplane);
        }

        return $this;
    }
}
