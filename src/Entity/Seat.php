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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $locked;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="seat")
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="seat")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrance", mappedBy="seat")
     */
    private $entrance;

    public function __construct()
    {
        $this->entrance = new ArrayCollection();
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
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

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

    public function getLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(?bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function getSeat(): ?Room
    {
        return $this->seat;
    }

    public function setSeat(?Room $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

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
    public function getEntrance(): Collection
    {
        return $this->entrance;
    }

    public function addEntrance(Entrance $entrance): self
    {
        if (!$this->entrance->contains($entrance)) {
            $this->entrance[] = $entrance;
            $entrance->setSeat($this);
        }

        return $this;
    }

    public function removeEntrance(Entrance $entrance): self
    {
        if ($this->entrance->contains($entrance)) {
            $this->entrance->removeElement($entrance);
            // set the owning side to null (unless already changed)
            if ($entrance->getSeat() === $this) {
                $entrance->setSeat(null);
            }
        }

        return $this;
    }
}
