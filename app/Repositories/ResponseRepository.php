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
    public function createResponse($id, $response, $userName){
        $this->responses::create([
            'contact_id' => $id,
            'response' => $response,
            'user_name' => $userName,
        ]);
    }

    public function getReponses(){
        $this->contact::has('responses')->get();
    }
}