<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\RegistredUsers;
class ContactRepository
{

    protected $contact;

    protected $user;

    public function __construct()
    {
        $this->contact = new Contact;
        $this->user = new RegistredUsers;

    }

    public function insertMessage($subject, $message, $user_id)
    {
        $this->contact::create([
            'subject' => $subject,
            'message' => $message,
            'user_id' => $user_id,
            'is_posted' => true,  
        ]);
    }

    public function updateMessage($subject, $message, $id)
    {
        $this
        ->contact
        ->find($id)
        ->update([
            'subject' => $subject,
            'message' => $message,
        ]);;
    }

    public function getInfoFromUser($id)
    {
        return $this->contact->find($id);
    }

    public function getPostedMessages()
    {
        return $this->contact->where('is_posted', true)->get();
    }
    public function deleteMessage($id)
    {
        $this
        ->contact
        ->find($id)
        ->delete();
    }

    public function getPostByTitle($nameOfPost)
    {
        return $this
        ->contact
        ->where('subject', $nameOfPost)
        ->get();
    }

    public function getAllMessages($id)
    {
        return $this
        ->contact
        ->where('user_id', $id)
        ->get();
    }
}