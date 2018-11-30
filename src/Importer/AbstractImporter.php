<?php
namespace App\Importer;

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
     * Adds a single category to the seating tool
     *
     * ```
     * $options = [
     *  'name' => string|null,
     *  'color' => string|null,
     *  'comment' => string|null
     * ]
     * ```
     *
     * @param array $options
     * @return Category
     */
    public function addCategory(array $options) :Category
    {

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

    }

}