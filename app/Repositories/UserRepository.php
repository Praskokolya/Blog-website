<?php

namespace App\Repositories;

use App\Models\UserInfo;

class UserRepository
{

    public $userInfo;

    public function __construct(UserInfo $userInfo)
    {
        $this->userInfo = $userInfo;
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function create($id)
    {
        $this->userInfo->create([
            'birthdate' => 'Not stated',
            'interests' => 'Not stated',
            'registred_users_id' => $id,
            'gender' => 'Not stated',
            'image' => 'images\without_picture.png',
        ]);
    }
    /**
     * Undocumented function
     *
     * @param [type] $user
     * @param [type] $birthdate
     * @param [type] $gender
     * @param [type] $interests
     * @param [type] $user_id
     * @return void
     */
    public function update($user, $birthdate, $gender, $interests, $user_id, $image)
    {
        $user->update([
            'birthdate' => $birthdate,
            'interests' => $interests,
            'registred_users_id' => $user_id,
            'gender' => $gender,
            'image' => $image,
        ]);
    }
}
