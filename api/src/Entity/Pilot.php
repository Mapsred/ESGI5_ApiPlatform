<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PilotRepository")
 */
class Pilot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="Airplane", cascade={"persist", "remove"}, mappedBy="pilot")
     */
    private $plane;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pilot
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Airplane|null
     */
    public function getPlane(): ?Airplane
    {
        return $this->plane;
    }

    /**
     * @param Airplane|null $plane
     * @return Pilot
     */
    public function setPlane(?Airplane $plane): self
    {
        $this->plane = $plane;

        return $this;
    }
}
