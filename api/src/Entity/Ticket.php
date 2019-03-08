<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "pdf"={
 *              "method"="GET",
 *              "path"="/tickets/{id}/pdf",
 *              "requirements"={"id"="\d+"},
 *              "controller"=App\Controller\PDFController::class,
 *              "formats"={"pdf"={"application/pdf"}}
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(10)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Passenger", inversedBy="tickets")
     */
    private $passenger;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AirplanePlace", cascade={"persist", "remove"}, mappedBy="ticket")
     */
    private $airplanePlace;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return Ticket
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPassenger(): ?Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(?Passenger $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAirplanePlace() :?AirplanePlace
    {
        return $this->airplanePlace;
    }

    /**
     * @param mixed $airplanePlace
     * @return Ticket
     */
    public function setAirplanePlace(?AirplanePlace $airplanePlace)
    {
        $this->airplanePlace = $airplanePlace;
        return $this;
    }
}
