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
    public function getLatestId()
    {
        if($this->contact->latest()->pluck('id')->first() == null){
            return 1;
        };
        return $this->contact->latest()->pluck('id')->first();
    }

    public function getUserImage(): ?string
    {
        if (Auth::check()) {
            return Auth::user()->userInfos->pluck('image')->first();
        }
        return null;
    }
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
        return $this->contact
            ->find($id);
    }

    /**
     * @return mixed
     */
    public function getPostedMessages()
    {
        return $this->contact
            ->join('registred_users', 'contacts.user_id', '=', 'registred_users.id')
            ->join('user_infos', 'contacts.user_id', '=', 'user_infos.registred_users_id')
            ->select(
                'contacts.id as contact_id',
                'registred_users.nickname',
                'contacts.subject',
                'contacts.message',
                'post_image',
                'user_infos.image',
                'registred_users.id as user_id'
            )
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
