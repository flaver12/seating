<?php
namespace App\Controller\Rest;

use Doctrine\ORM\EntityManagerInterface;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Seat;
use App\Repository\SeatRepository;

/**
 * Seat Rest api class
 * handles all calls for the seats
 *
 * @author Flavio Kleiber <zerberain@outlook.com>
 * @package Api
 */
class SeatController extends FOSRestController {

    /**
     * @Rest\Get("/seat")
     *
     * @return View
     */
    public function getSeat(SeatRepository $seatRepo) :View
    {
        $seats = $seatRepo->findAll();
        return View::create($seats, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/seat")
     *
     * @return View
     */
    public function postSeat(Request $request, EntityManagerInterface $entityManager) :View
    {
        $seat = new Seat();
        $seat->setName('Test');
        $seat->setOrderNumber(1);
        $entityManager->persist($seat);
        $entityManager->flush();
        return View::create($seat, Response::HTTP_OK);
    }
}