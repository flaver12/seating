<?php
namespace App\Controller\Rest;

use Doctrine\ORM\EntityManagerInterface;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Faker\Factory;

use App\Importer\ArrayImporter;
use App\Entity\Seat;
use App\Entity\Row;

/**
 * Seat Rest api class
 * handles all calls for the seats
 *
 * @author Flavio Kleiber <zerberain@outlook.com>
 * @package Controller.Api
 */
class ImportController extends FOSRestController {

    /**
     * @Rest\Post("/import")
     *
     * @return View
     */
    public function import(Request $request, ArrayImporter $import) :View
    {

        // @todo: REMOVE FAKER!
        $faker = Factory::create();
        $data = [];
        
        for($i = 0; $i < 5; $i ++) {
            $category['name'] = $faker->word;
            $category['color'] = $faker->hexcolor;
            $data['categories'][] = $category;
        }

        for($i = 0; $i < 2; $i ++) {
            $group['name'] = $faker->word;
            $group['color'] = $faker->hexcolor;
            $data['groups'][] = $group;
        }

        for($i = 0; $i < 10; $i ++) {
            $catgeory = $data['categories'][(array_rand($data['categories']))];
            $ticket['name'] = $faker->name;
            $ticket['color'] = $faker->hexcolor;
            $ticket['category'] = $catgeory;
            $data['tickets'][] = $ticket;
        }

        for($i = 0; $i < 10; $i ++) {
            $group = $data['groups'][(array_rand($data['groups']))];
            $ticket = $data['tickets'][$i];
            $guest['first_name'] = $faker->firstName;
            $guest['last_name'] = $faker->lastName;
            $guest['email'] = $faker->email;
            $guest['ticket'] = $ticket;
            $guest['group'] = $group;
            $data['guests'][] = $guest;
        }

        for($i = 0; $i < 10; $i ++) {
            $catgeory = $data['categories'][(array_rand($data['categories']))];
            $ticket['name'] = $faker->name;
            $ticket['color'] = $faker->hexcolor;
            $ticket['category'] = $catgeory;
            $data['tickets'][] = $ticket;
        }

        $data = $import->import($data);
        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/seat")
     *
     * @return View
     */
    public function postSeat(Request $request, EntityManagerInterface $entityManager) :View
    {
        $data = [];
        $faker = Factory::create();
        $row = new Row();
        $row->setName('1');
        $entityManager->persist($row);
        for($i = 0; $i < 10; $i ++) {
            $seat = new Seat();
            $seat->setName('Seat '.$i);
            $seat->setRow($row);
            $seat->setOrderNumber(1);
            $data[] = $seat;
            $entityManager->persist($seat);
        }
        $entityManager->flush();
        return View::create($data, Response::HTTP_OK);
    }
}