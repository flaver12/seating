<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
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
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Seat", mappedBy="room")
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
            $seat->setSeat($this);
        }

        return $this;
    }

    public function removeSeat(Seat $seat): self
    {
        if ($this->seat->contains($seat)) {
            $this->seat->removeElement($seat);
            // set the owning side to null (unless already changed)
            if ($seat->getSeat() === $this) {
                $seat->setSeat(null);
            }
        }

        return $this;
    }
}
