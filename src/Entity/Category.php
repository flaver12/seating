<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Seat", mappedBy="category")
     */
    private $seat;

    public function __construct()
    {
        $this->seat = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Seat[]
     */
    public function getSeat(): Collection
    {
        return $this->seat;
    }

    public function addSeat(Seat $seat): self
    {
        if (!$this->seat->contains($seat)) {
            $this->seat[] = $seat;
            $seat->setCategory($this);
        }

        return $this;
    }

    public function removeSeat(Seat $seat): self
    {
        if ($this->seat->contains($seat)) {
            $this->seat->removeElement($seat);
            // set the owning side to null (unless already changed)
            if ($seat->getCategory() === $this) {
                $seat->setCategory(null);
            }
        }

        return $this;
    }
}
