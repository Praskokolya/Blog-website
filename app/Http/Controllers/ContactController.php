<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Exception;
use App\Services\ContactService;
use App\Repositories\ContactRepository;

class ContactController extends Controller

{
    public $contactService;
    public $contactRepository;
    public function __construct(ContactService $contactService, ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->contactService = $contactService;
        $this->middleware('auth')->only('allData');
    }


    public function submit(ContactRequest $req)
    {
        $subject = $req->input('subject');
        $message = $req->input('message');
        $this->contactRepository->insertMessage($subject, $message);
        return view('home');
    }

    public function allData()
    {
        return view('messages', ['data' => $this->contactRepository->getAllMessages()]);
    }
    public function showOneMessage($id)
    {
        $user = Auth::user()->nickname;

        $this->contactService->transmitUserData($user, $id);

        $postInfo = $this->contactRepository->getInfoFromUser($id);
        return view('OneMessage', ['data' => $postInfo, 'name' => $user]);
    }

    public function updateMessage($id)
    {
        $postInfo = $this->contactRepository->getInfoFromUser($id);
        return view('update',  ['data' => $postInfo]);
    }

    public function updateMessageSubmit($id, ContactRequest $req)
    {
        $subject = $req->input('subject');
        $message = $req->input('message');

        $this->contactRepository->updateMessage($subject, $message, $id);

        return redirect()->route('contactDataOne', $id)->with('success', 'Post was updated');
    }

    public function deleteMessage($id)
    {
        $this->contactRepository->deleteMessage($id);
        return redirect()->route('contactData')->with('success', 'Post delete successful');
    }

    public function getPostByTitle(Request $req)
    {
        $nameOfPost = $req->namePost;
        $this->contactRepository->getPostByTitle($nameOfPost);

        $result = $this->contactRepository->getPostByTitle($nameOfPost);

        if ($result->isEmpty()) {
            return redirect()->route('contactData')->with('error', 'Post not found');
        } else {
            return view('oneTitle', ['data' => $result]);
        }
    }

    public function showHomePage()
    {

        return view('home', ['data' => $this
        ->contactRepository
        ->getPostedMessages()]);
    }

    public function addMessage($id)
    {
        try {
            $this->contactRepository->getPostForCheck($id);
            return redirect('/');
        } catch (Exception $e) {
            return redirect()->route('contactData')->with('error', 'Message already posted');
        }
    }
}
