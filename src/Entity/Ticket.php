<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="string", length=145, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=545, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tickets")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guest", mappedBy="ticket")
     */
    private $guests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrance", mappedBy="ticket")
     */
    private $entrances;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
        $this->entrances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Guest[]
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
            $guest->setTicket($this);
        }

        return $this;
    }

    public function removeGuest(Guest $guest): self
    {
        if ($this->guests->contains($guest)) {
            $this->guests->removeElement($guest);
            // set the owning side to null (unless already changed)
            if ($guest->getTicket() === $this) {
                $guest->setTicket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entrance[]
     */
    public function getEntrances(): Collection
    {
        return $this->entrances;
    }

    public function addEntrance(Entrance $entrance): self
    {
        if (!$this->entrances->contains($entrance)) {
            $this->entrances[] = $entrance;
            $entrance->setTicket($this);
        }

        return $this;
    }

    public function removeEntrance(Entrance $entrance): self
    {
        if ($this->entrances->contains($entrance)) {
            $this->entrances->removeElement($entrance);
            // set the owning side to null (unless already changed)
            if ($entrance->getTicket() === $this) {
                $entrance->setTicket(null);
            }
        }

        return $this;
    }
}
