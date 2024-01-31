<?php

namespace App\Repositories;

use App\Models\Contact;

class TwitterRepository

{
    public $contact;

    public function __construct(Contact $contact) {
        $this->contact = $contact;
    }
    public function getPostById($id){
        return $this->contact->find($id);
    }
}
