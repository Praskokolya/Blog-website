<?php

namespace App\Services;
use App\Repositories\ContactRepository;
class ContactService{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }
    public function insertToDB(string $message, string $subject){
        $this->contactRepository->insertMessage($message, $subject);
    }
}