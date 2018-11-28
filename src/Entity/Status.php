<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=145, nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrance", mappedBy="status")
     */
    private $entrances;

    public function __construct()
    {
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

    public function setName(string $name): self
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
            $entrance->setStatus($this);
        }

        return $this;
    }

    public function removeEntrance(Entrance $entrance): self
    {
        if ($this->entrances->contains($entrance)) {
            $this->entrances->removeElement($entrance);
            // set the owning side to null (unless already changed)
            if ($entrance->getStatus() === $this) {
                $entrance->setStatus(null);
            }
        }

        return $this;
    }
}
