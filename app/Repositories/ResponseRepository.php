<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\Responses;

class ResponseRepository{
    public $responses; 
    public $contact;
    public function __construct(Responses $responses, Contact $contact) {
        $this->responses = $responses;
        $this->contact = $contact;
    }
    public function createResponse($data){
        $this->responses::create($data);
    }

    public function getReponses(){
        $this->contact::has('responses')->get();
    }
}