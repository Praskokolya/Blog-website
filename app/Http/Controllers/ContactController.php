<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Repositories\ContactRepository;
use App\Repositories\ResponseRepository;

class ContactController extends Controller
{
    /** @var ContactService */
    private $contactService;

    /** @var ContactRepository */
    public $contactRepository;

    public $responseRepository;

    /**
     * ContactController constructor
     *
     * @param ContactService $contactService
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactService $contactService, ContactRepository $contactRepository, ResponseRepository $responseRepository)
    {
        $this->responseRepository = $responseRepository;
        $this->contactRepository = $contactRepository;
        $this->contactService = $contactService;
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function all()
    {

        $allPosts = Contact::find($this->contactRepository->getAllMessages(Auth::id()));
        return view('messages', ['data' => $allPosts]);
    }

    /**
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function message(int $id)
    {
        $user = Auth::user()->nickname;
        $this
            ->contactService
            ->transmitUserData($user, $id);

        $postInfo = $this
            ->contactRepository
            ->getInfoFromUser($id);
        return view('OneMessage', ['data' => $postInfo, 'name' => $user]);
    }

    /**
     * @method updateMessage
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function update(int $id)
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
    protected function updateSubmit(int $id, ContactRequest $req)
    {
        $subject = $req->input('subject');
        $message = $req->input('message');

        $this->contactRepository
            ->updateMessage($subject, $message, $id);

        return redirect()
            ->route('contactDataOne', $id)
            ->with('success', 'Post was updated');
    }

    /**
     * @method deleteMessage()
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function delete(int $id)
    {
        $this->contactRepository
            ->deleteMessage($id);
        return redirect()->route('contactData')->with('success', 'Post delete successful');
    }

    /**
     * @method getPostByTitle()
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function getPost(Request $request)
    {
        if ($this
            ->contactRepository
            ->getPostByTitle($request->namePost, Auth::id())
            ->isEmpty()
        ) {
            return redirect()->route('contactData')->with('error', 'Post not found');
        } else {
            return view('messages', ['data' => $this->contactRepository->getPostByTitle($request->namePost, Auth::id())]);
        }
    }

    /**
     * @method showHomePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showHomePage()
    {
        return view('home', ['data' => $this->contactRepository->getPostedMessages(), 'responses' => $this->responseRepository->getReponses()]);
    }
    public function responseForm()
    {
        return view('home', ['data' => $this->contactRepository->getPostedMessages()]);
    }
    public function responseCreate(Request $request)
    {
        $response = $request->input('data');
        $id = $request->input('post_id');
        $this->responseRepository->createResponse($id, $response, Auth::user()->nickname);
        return redirect()->back();
    }
}
