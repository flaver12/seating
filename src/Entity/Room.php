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
     * @ORM\Column(type="string", length=145)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=455, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubRoom", mappedBy="room")
     */
    private $subRooms;

    public function __construct()
    {
        $this->subRooms = new ArrayCollection();
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
     * @return Collection|SubRoom[]
     */
    public function getSubRooms(): Collection
    {
        return $this->subRooms;
    }

    public function addSubRoom(SubRoom $subRoom): self
    {
        if (!$this->subRooms->contains($subRoom)) {
            $this->subRooms[] = $subRoom;
            $subRoom->setRoom($this);
        }

        return $this;
    }

    public function removeSubRoom(SubRoom $subRoom): self
    {
        if ($this->subRooms->contains($subRoom)) {
            $this->subRooms->removeElement($subRoom);
            // set the owning side to null (unless already changed)
            if ($subRoom->getRoom() === $this) {
                $subRoom->setRoom(null);
            }
        }

        return $this;
    }
}
