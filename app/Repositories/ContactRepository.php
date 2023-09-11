<?php

namespace App\Repositories;
use App\Models\Contact;
class ContactRepository{
        
    public function __construct(){
        $this->contact = new Contact;
    }

    public function insertMessage($subject, $message){
        $this->contact::create([
            'subject' => $subject,
            'message' => $message,

        ]);
    }
}