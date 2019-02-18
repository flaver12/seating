<?php
namespace App\Importer;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Category;
use App\Entity\Group;
use App\Entity\Ticket;
use App\Entity\Guest;

/**
 * Base class for all importers
 *
 * @author Flavio Kleiber <zerbarian@outlook.com>
 * @package Importer
 */
abstract class AbstractImporter {

    /**
     * EntityManager
     *
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public abstract function import($data);

    /**
     * Adds a single category to the seating tool
     *
     * ```
     * $options = [
     *  'name' => string,
     *  'color' => string,
     *  'comment' => string
     * ]
     * ```
     *
     * @param array $options
     * @return Category
     */
    public function addCategory(array $options) :Category
    {
        $category = new Category();
        $name = isset($options['name']) ? $options['name'] : null;
        $color = isset($options['color']) ? $options['color'] : null;
        $comment = isset($options['comment']) ? $options['comment'] : null;

        $category->setName($name);
        $category->setColor($color);
        $category->setComment($comment);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

    /**
     * Adds a single group to the seating tool
     *
     * ```
     * $options = [
     *  'name' => string,
     *  'color' => string | null,
     *  'comment' => string | null
     * ]
     *```
     *
     * @param array $options
     * @return Group
     */
    public function addGroup(array $options) :Group
    {
        $group = new Group();
        $name = $options['name'];
        $color = isset($options['color']) ? $options['color'] : null;
        $comment = isset($options['comment']) ? $options['comment'] : null;

        $group->setName($name);
        $group->setColor($color);
        $group->setComment($comment);

        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return $group;
    }

    /**
     * Adds a single ticket to the seating tool
     *
     * ```
     * $options = [
     *  'category' => Category Entity
     *  'name' => string|null,
     *  'comment' => string|null
     * ]
     * ```
     *
     * @param array $options
     * @return Ticket
     */
    public function addTicket(array $options) :Ticket
    {
        $ticket = new Ticket();
        $category = isset($options['category']) ? $options['category'] : null;
        $name = isset($options['name']) ? $options['name'] : null;
        $comment = isset($options['comment']) ? $options['comment'] : null;

        if($category) {
            $category = $this->entityManager->getRepository(Category::class)->findOneByName($category);
        }

        $ticket->setCategory($category);
        $ticket->setName($name);
        $ticket->setComment($comment);

        $this->entityManager->persist($ticket);
        $this->entityManager->flush();

        return $ticket;
    }

    /**
     * Adds a single guest to the seating tool
     *
     * ```
     * $options = [
     *  'first_name' => string
     *  'last_name' => string,
     *  'email' => string,
     *  'ticket' => Ticket Entity,
     *  'secret' => string|null,
     *  'comment' => string|null,
     *  'subg_id' => number|null
     *  'group' => Group Entity | null
     * ]
     * ```
     *
     * @param array $options
     * @return Guest
     */
    public function addGuest(array $options) :Guest
    {
        $guest = new Guest();
        $firstName = isset($options['first_name']) ? $options['first_name'] : null;
        $lastName = isset($options['last_name']) ? $options['last_name'] : null;
        $email = isset($options['email']) ? $options['email'] : null;
        $ticket = isset($options['ticket']) ? $options['ticket'] : null;
        $secret = isset($options['secret']) ? $options['secret'] : null;
        $comment = isset($options['comment']) ? $options['comment'] : null;
        $subgId = isset($options['subg_id']) ? $options['subg_id'] : null;
        $group = isset($options['group']) ? $options['group'] : null;

        if($ticket) {
            $ticket = $this->entityManager->getRepository(Ticket::class)->findOneByName($ticket['name']);
        }

        if($group) {
            $group = $this->entityManager->getRepository(Group::class)->findOneByName($group);
        }

        $guest->setFirstName($firstName);
        $guest->setLastName($lastName);
        $guest->setEmail($email);
        $guest->setTicket($ticket);
        $guest->setSecret($secret);
        $guest->setComment($comment);
        $guest->setSubgId($subgId);
        $guest->setGroups($group);

        $this->entityManager->persist($guest);
        $this->entityManager->flush();

        return $guest;
    }

}