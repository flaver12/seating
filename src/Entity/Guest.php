<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuestRepository")
 */
class Guest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=415)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=455)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=245, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=245, nullable=true)
     */
    private $secret;

    /**
     * @ORM\Column(type="string", length=545, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="guests")
     */
    private $ticket;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="guests")
     */
    private $groups;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subgId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(?string $secret): self
    {
        $this->secret = $secret;

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

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getGroups(): ?Group
    {
        return $this->groups;
    }

    public function setGroups(?Group $groups): self
    {
        $this->groups = $groups;

        return $this;
    }

    public function getSubgId(): ?int
    {
        return $this->subgId;
    }

    public function setSubgId(?int $subgId): self
    {
        $this->subgId = $subgId;

        return $this;
    }
}
