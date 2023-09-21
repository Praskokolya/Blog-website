<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{

    protected $contact;

    public function __construct()
    {
        $this->contact = new Contact;
    }

    public function insertMessage($subject, $message)
    {
        $this->contact::create([
            'subject' => $subject,
            'message' => $message,
            'is_posted' => true,

        ]);
    }

    public function updateMessage($subject, $message, $id)
    {
        $messageForUpdate = $this->contact->find($id);

        $messageForUpdate->update([
            'subject' => $subject,
            'message' => $message,
        ]);
    }

    public function getInfoFromUser($id)
    {
        $postInfo = $this->contact->find($id);
        return $postInfo;
    }

    public function getPostedMessages()
    {
        $allPosts = $this->contact->where('is_posted', true)->get();
        return $allPosts;
    }
    public function deleteMessage($id)
    {
        $messageForDelete = $this->contact->find($id);
        $messageForDelete->delete();
    }

    public function getPostByTitle($nameOfPost)
    {
        $currentPost = $this->contact->where('subject', $nameOfPost)->get();
        return $currentPost;
    }
    // public function getPostForCheck($id)
    // {
    //     $this->contact->find($id)->is_posted->postMessage($id);
    // }
    public function getAllMessages()
    {
        return $this->contact->All();
    }
}