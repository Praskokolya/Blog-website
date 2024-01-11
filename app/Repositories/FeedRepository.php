<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use App\Repositories\GetPosts;

class FeedRepository extends GetPosts
{
    public $registredUsers;
    public function __construct(RegistredUsers $registredUsers)
    {
        $this->registredUsers = $registredUsers;
    }

    public function getRegistredUsers()
    {
        return $this->registredUsers->with('userInfos')->paginate(3);
    }
    public function getUserDataById(int $id)
    {
        return $this->registredUsers->with('userInfos')->find($id);
    }
}
