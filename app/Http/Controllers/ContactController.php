<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /** @var ContactService */
    private $contactService;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(ContactRequest $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');
        $this->contactRepository->insertMessage($subject, $message, Auth::id());
        return redirect('/');
    }

    /**
     * @method allData
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function allData()
    {
        return view('messages', ['data' => $this->contactRepository->getAllMessages(Auth::id())]);
    }

    /**
     * @method showOneMessage
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showOneMessage(int $id)
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
    protected function updateMessage(int $id)
    {
        return view('update', ['data' => $this->contactRepository->getInfoFromUser($id)]);
    }

    /**
     * @method updateMessageSubmit()
     *
     * @param integer $id
     * @param ContactRequest $req
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateMessageSubmit(int $id, ContactRequest $req)
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
    protected function deleteMessage(int $id)
    {
        $this->contactRepository->deleteMessage($id);
        return redirect()->route('contactData')->with('success', 'Post delete successful');
    }

    /**
     * @method getPostByTitle()
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    protected function getPostByTitle(Request $request)
    {
        if ($this
        ->contactRepository
        ->getPostByTitle($request->namePost)
        ->isEmpty()) {
            return redirect()->route('contactData')->with('error', 'Post not found');
        } else {
            return view('oneTitle', ['data' => $this->contactRepository->getPostByTitle($request->namePost)]);
        }
    }

    /**
     * @method showHomePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showHomePage()
    {
        return view('home', ['data' => $this->contactRepository->getPostedMessages()]);
    }
}