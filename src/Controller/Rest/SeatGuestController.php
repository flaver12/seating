<?php
namespace App\Controller\Rest;

use Doctrine\ORM\EntityManagerInterface;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Seating\Seater;

/**
 * Seat Rest api class
 * handles all calls for the seats
 *
 * @author Flavio Kleiber <zerberain@outlook.com>
 * @package Controller.Api
 */
class SeatGuestController extends FOSRestController {

    /**
     * @Rest\Post("/seat/guest")
     *
     * @return View
     */
    public function seatGuest(Request $request, Seater $seater)
    {
        $body = json_decode($request->getContent());
        $seater->seat($body->guest);
        $data = ['status' => 'seated!'];
        return View::create($data, Response::HTTP_CREATED);
    }
}