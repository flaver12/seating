<?php

namespace App\Seating;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\GuestRepository;
use App\Repository\SeatRepository;
use App\Entity\Entrance;

class Seater {

    protected $entityManager;

    protected $guestRepo;

    protected $seatRepo;

    public function __construct(
        EntityManagerInterface $entityManager, 
        GuestRepository $guestRepo,
        SeatRepository $seatRepo
    )
    {
        $this->entityManager = $entityManager;
        $this->guestRepo = $guestRepo;
        $this->seatRepo = $seatRepo;
    }

    public function seat($guestId, $catgeoryId = null)
    {
        //No category set, then get all free seats(no category)
        if(!$catgeoryId) {
            $seats = $this->getAllFreeSeats();
            //@todo add check for odernumber and for how to seat
            $seat = $seats[0];
            $guest = $this->guestRepo->find($guestId);
            $ticket = $guest->getTicket();
            $entrance = new Entrance();
            $entrance->setSeat($seat);
            $entrance->setTicket($ticket);
            $this->entityManager->persist($entrance);
            $this->entityManager->flush();
        }
    }

    protected function getAllFreeSeats()
    {
        $freeSeats = [];
        $seats = $this->seatRepo->findBy(['category' => null]);
        foreach($seats as $seat) {
            if(!$seat->getEntrances()->contains($seat)) {
               $freeSeats[] = $seat;
            }
        }

        return $freeSeats;
    }

}