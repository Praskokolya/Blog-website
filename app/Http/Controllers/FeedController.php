<?php

namespace App\Http\Controllers;

use App\Repositories\FeedRepository;
use App\Repositories\GetPosts;

class FeedController
{
    /**
     * @var FeedRepository
     */
    public $feedRepository;
    
    /**
     * @var GetPosts
     */
    public $getPosts;

    /**
     * @param FeedRepository $feedRepository
     * @param GetPosts       $getPosts
     */
    public function __construct(FeedRepository $feedRepository, GetPosts $getPosts)
    {
        $this->feedRepository = $feedRepository;
        $this->getPosts = $getPosts;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getAllUsers()
    {
        return view('feed', ['data' => $this->feedRepository->getRegistredUsers()]);
    }

    /**
     * @param int $id User ID
     * @return \Illuminate\Contracts\View\View
     */
    public function getOneUser(int $id)
    {
        $userData = $this->feedRepository->getUserDataById($id);
        $posts = $this->getPosts->getPostByUserId($id);
        $amountOfPosts = $posts->count();
        
        return view('user.UserProfile', ['posts' => $posts, 'data' => $userData, 'amountOfPosts' => $amountOfPosts]);
    }
}
