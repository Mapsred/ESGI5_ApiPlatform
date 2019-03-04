<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $borrowind_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $return_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="Borrower", inversedBy="borrows")
     */
    private $borrower;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CopyBook", inversedBy="borrows")
     */
    private $copy_book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowindDate(): ?\DateTimeInterface
    {
        return $this->borrowind_date;
    }

    public function setBorrowindDate(\DateTimeInterface $borrowind_date): self
    {
        $this->borrowind_date = $borrowind_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->return_date;
    }

    public function setReturnDate(\DateTimeInterface $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    public function setBorrower(?Borrower $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }

    public function getCopyBook(): ?CopyBook
    {
        return $this->copy_book;
    }

    public function setCopyBook(?CopyBook $copy_book): self
    {
        $this->copy_book = $copy_book;

        return $this;
    }
}
