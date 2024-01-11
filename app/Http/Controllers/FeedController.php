<?php

namespace App\Http\Controllers;

use App\Repositories\FeedRepository;
use App\Repositories\GetPosts;

class FeedController extends Controller
{
    public $feedRepository;
    public $getPosts; 
    public function __construct(FeedRepository $feedRepository, GetPosts $getPosts){
        $this->feedRepository = $feedRepository;
        $this->getPosts = $getPosts;
    }
    public function getAllUsers(){
        return view('feed', ['data' => $this->feedRepository->getRegistredUsers()]);
    }
    
    public function getOneUser(int $id){
        $userData = $this->feedRepository->getUserDataById($id);
        $posts = $this->getPosts->getPostByUserId($id);
        $amountOfPosts = $posts->count();
        return view('user.UserProfile', ['posts' => $posts, 'data' => $userData, 'amountOfPosts' => $amountOfPosts]);
    }

}
