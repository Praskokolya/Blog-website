<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\RegistredUsers;
use Illuminate\Support\Facades\Auth;

/**
 * Class ContactRepository
 * @package App\Repositories
 */
class ContactRepository
{
    protected $contact;
    protected $user;

    private const DEFAULT_POSTS_PER_PAGE = 3;

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
    public function insertMessage(array $requestData)
    {
        $requestData['user_id'] = Auth::id();
        $this->contact->create($requestData);
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
                'user_id' => Auth::id(),
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
            ->select('contacts.id', 'registred_users.nickname', 'contacts.subject', 'contacts.message', 'post_image')
            ->paginate(self::DEFAULT_POSTS_PER_PAGE);
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
