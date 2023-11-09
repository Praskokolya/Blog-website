<?php

namespace App\Services;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\Auth;

class ContactService{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;  
    }
    public function savePostPhoto($image){
        return $image->storeAs('postPhoto', $image->getClientOriginalName(), 'public');
    }
    public function transmitUserData($user, int $id){
        if($user){
            $this->contactRepository->getInfoFromUser($id);
        }
    }    
}