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
    /** @var ContactService */
    public $contactService;

    /** @var ContactRepository */
    public $contactRepository;

    /**
     * ContactController constructor
     *
     * @param ContactService $contactService
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactService $contactService, ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->contactService = $contactService;
        $this->middleware('auth')->only('allData');
    }

    /**
     * @method submit()
     *
     * @param ContactRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submit(ContactRequest $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');
        $this->contactRepository->insertMessage($subject, $message);
        return view('home');
    }

    /**
     * @method allData
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allData()
    {
        return view('messages', ['data' => $this->contactRepository->getAllMessages()]);
    }

    /**
     * @method showOneMessage
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOneMessage(int $id)
    {
        $user = Auth::user()->nickname;
        $this->contactService->transmitUserData($user, $id);
        $postInfo = $this->contactRepository->getInfoFromUser($id);
        return view('OneMessage', ['data' => $postInfo, 'name' => $user]);
    }

    /**
     * @method updateMessage
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateMessage(int $id)
    {
        $postInfo = $this->contactRepository->getInfoFromUser($id);
        return view('update',  ['data' => $postInfo]);
    }

    /**
     * @method updateMessageSubmit()
     *
     * @param integer $id
     * @param ContactRequest $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMessageSubmit(int $id, ContactRequest $req)
    {
        $subject = $req->input('subject');
        $message = $req->input('message');
        $this->contactRepository->updateMessage($subject, $message, $id);
        return redirect()->route('contactDataOne', $id)->with('success', 'Post was updated');
    }

    /**
     * @method deleteMessage()
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMessage(int $id)
    {
        $this->contactRepository->deleteMessage($id);
        return redirect()->route('contactData')->with('success', 'Post delete successful');
    }

    /**
     * @method getPostByTitle()
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostByTitle(Request $request)
    {
        $result = $this->contactRepository->getPostByTitle($request->namePost);
        if ($result->isEmpty()) {
            return redirect()->route('contactData')->with('error', 'Post not found');
        } else {
            return view('oneTitle', ['data' => $result]);
        }
    }

    /**
     * @method showHomePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        return view('home', ['data' => $this->contactRepository->getPostedMessages()]);
    }

    /**
     * @method addMessage()
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addMessage(int $id)
    {
        try {
            $this->contactRepository->getPostForCheck($id);
            return redirect('/');
        } catch (Exception $e) {
            return redirect()->route('contactData')->with('error', 'Message already posted');
        }
    }
}
