<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeatRepository")
 */
class Seat
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
     * @ORM\Column(type="bigint")
     */
    private $order_number;

    /**
     * @ORM\Column(type="string", length=445, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $posX;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $posY;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rotation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $locked;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubRoom", inversedBy="seats")
     */
    private $subRoom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Row", inversedBy="seats")
     */
    private $row;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="seats")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrance", mappedBy="seat")
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

    public function getOrderNumber(): ?int
    {
        return $this->order_number;
    }

    public function setOrderNumber(int $order_number): self
    {
        $this->order_number = $order_number;

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

    public function getPosX(): ?int
    {
        return $this->posX;
    }

    public function setPosX(?int $posX): self
    {
        $this->posX = $posX;

        return $this;
    }

    public function getPosY(): ?int
    {
        return $this->posY;
    }

    public function setPosY(?int $posY): self
    {
        $this->posY = $posY;

        return $this;
    }

    public function getRotation(): ?int
    {
        return $this->rotation;
    }

    public function setRotation(?int $rotation): self
    {
        $this->rotation = $rotation;

        return $this;
    }

    public function getLocked(): ?int
    {
        return $this->locked;
    }

    public function setLocked(?int $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function getSubRoom(): ?SubRoom
    {
        return $this->subRoom;
    }

    public function setSubRoom(?SubRoom $subRoom): self
    {
        $this->subRoom = $subRoom;

        return $this;
    }

    public function getRow(): ?Row
    {
        return $this->row;
    }

    public function setRow(?Row $row): self
    {
        $this->row = $row;

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
            $entrance->setSeat($this);
        }

        return $this;
    }

    public function removeEntrance(Entrance $entrance): self
    {
        if ($this->entrances->contains($entrance)) {
            $this->entrances->removeElement($entrance);
            // set the owning side to null (unless already changed)
            if ($entrance->getSeat() === $this) {
                $entrance->setSeat(null);
            }
        }

        return $this;
    }
}
