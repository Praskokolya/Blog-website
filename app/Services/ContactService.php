<?php

namespace App\Services;
use App\Repositories\ContactRepository;
class ContactService{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository){
        return $this->contactRepository = $contactRepository;
        
    }
    public function transmitUserData($user, int $id){
        if($user){
            $this->contactRepository->getInfoFromUser($id);
        }
    }
    
    public function checkIfEmpty($nameOfPost){
        
        
    }


}