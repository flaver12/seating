<?php

namespace App\Importer;

class ArrayImporter extends AbstractImporter {

    public function import($data)
    {
        //import all categories
        for($i = 0; $i < count($data['categories']); $i ++) {
            $catgeory = $this->addCategory($data['categories'][$i]);
            $data['categories'][$i] = $catgeory;
        }

        //import all groups
        for($i = 0; $i < count($data['groups']); $i ++) {
            $group = $this->addGroup($data['groups'][$i]);
            $data['groups'][$i] = $group;
        }
        
        //import all tickets
        for($i = 0; $i < count($data['tickets']); $i ++) {
            $ticket = $this->addTicket($data['tickets'][$i]);
            $data['tickets'][$i] = $ticket;
        }
        //import all guests
        for($i = 0; $i < count($data['guests']); $i ++) {
            $guest = $this->addGuest($data['guests'][$i]);
            $data['guests'][$i] = $guest;
        }

        return $data;
    }
}