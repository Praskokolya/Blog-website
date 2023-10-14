<?php

namespace App\Repositories;

use App\Models\Contact;

class GetPosts
{
    /**
     * Undocumented variable
     *
     * @var $contact
     */
    public $contact;
    /**
     * GetPosts constructor
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    /**
     *
     * @param integer $userId
     * just put id of user and it get all post of this user
     * @return \Illuminate\Support\Collection
     */
    public function getPostByUserId(int $userId)
    {
        return $this->contact->join('registred_users', 'contacts.user_id', '=', 'registred_users.id')
            ->where('contacts.user_id', $userId)
            ->select('contacts.message', 'contacts.subject', 'registred_users.email', 'registred_users.nickname')
            ->get();
    }
}
