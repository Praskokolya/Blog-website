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

    public function updateMessage($subject, $message, $id){
        $messageForUpdate = $this->contact->find($id);
    
        $messageForUpdate->update([
            'subject' => $subject,
            'message' => $message,
        ]);
    }

    public function getInfoFromUser($id){
        $postInfo = $this->contact->find($id);
        return $postInfo;
    }

    public function getPostedMessages(){
        $allPosts = $this->contact->where('is_posted', true)->get();
        return $allPosts;
    }

    public function deleteMessage($id){
        $messageForDelete = $this->contact->find($id);
        $messageForDelete->delete();
    }
    
    public function getPostByTitle($nameOfPost){
        $currentPost = $this->contact->where('subject', $nameOfPost)->get();
        return $currentPost;
    }
    
}