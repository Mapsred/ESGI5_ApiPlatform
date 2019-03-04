<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime $borrowind_date
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $borrowind_date;

    /**
     * @var \DateTime $return_date
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\GreaterThan(propertyPath="borrowing_date")
     */
    private $return_date;

    /**
     * @var string $state
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @var Borrower $borrower
     * @ORM\ManyToOne(targetEntity="Borrower", inversedBy="borrows")
     */
    private $borrower;

    /**
     * @var CopyBook $copy_book
     * @ORM\ManyToOne(targetEntity="App\Entity\CopyBook", inversedBy="borrows")
     */
    private $copy_book;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getBorrowindDate(): ?\DateTime
    {
        return $this->borrowind_date;
    }

    /**
     * @param \DateTime $borrowind_date
     * @return Borrow
     */
    public function setBorrowindDate(\DateTime $borrowind_date): self
    {
        $this->borrowind_date = $borrowind_date;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getReturnDate(): ?\DateTime
    {
        return $this->return_date;
    }

    /**
     * @param \DateTime $return_date
     * @return Borrow
     */
    public function setReturnDate(\DateTime $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Borrow
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Borrower|null
     */
    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    /**
     * @param Borrower|null $borrower
     * @return Borrow
     */
    public function setBorrower(?Borrower $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }

    /**
     * @return CopyBook|null
     */
    public function getCopyBook(): ?CopyBook
    {
        return $this->copy_book;
    }

    /**
     * @param CopyBook|null $copy_book
     * @return Borrow
     */
    public function setCopyBook(?CopyBook $copy_book): self
    {
        $this->copy_book = $copy_book;

        return $this;
    }
}
