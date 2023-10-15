<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\RegistredUsers;

/**
 * Class ContactRepository
 * @package App\Repositories
 */
class ContactRepository
{
    protected $contact;
    protected $user;

    /**
     * ContactRepository constructor
     */
    public function __construct(Contact $contact, RegistredUsers $user)
    {
        $this->contact = $contact;
        $this->user = $user;
    }

    /**
     * @param string $subject
     * @param string $message
     * @param integer $user_id
     * @return void
     */
    public function insertMessage(string $subject, string $message, int $user_id)
    {
        $this->contact->create([
            'subject' => $subject,
            'message' => $message,
            'user_id' => $user_id,
            'is_posted' => true,
        ]);
    }

    /**
     *
     * @param string $subject
     * @param string $message
     * @param integer $id
     * @return void
     */

    public function updateMessage(string $subject, string $message, int $id)
    {
        $this
            ->contact
            ->find($id)
            ->update([
                'subject' => $subject,
                'message' => $message,
            ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function getInfoFromUser(int $id)
    {
        return $this
            ->contact
            ->find($id);
    }

    /**
     * @return mixed
     */
    public function getPostedMessages()
    {
        return $this->contact->join('registred_users', 'contacts.user_id', '=', 'registred_users.id')
            ->select('contacts.id', 'registred_users.nickname', 'contacts.subject', 'contacts.message')
            ->paginate(3);
    }

    /**
     * @param integer $id
     */
    public function deleteMessage(int $id)
    {
        $this
            ->contact::find($id)
            ->delete();
    }

    /**
     * @param string $nameOfPost
     * @param integer $id
     * @return mixed
     */
    public function getPostByTitle(string $nameOfPost, int $id)
    {
        return Contact::where('user_id', $id)
            ->where('subject', $nameOfPost)->get();
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function getAllMessages($id)
    {
        return $this->contact::with('RegistredUsers')
            ->where('user_id', $id)
            ->pluck('id');
    }
}
