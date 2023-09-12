<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\RegistredUsers;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Services\ContactService;
use App\Repositories\ContactRepository;
class ContactController extends Controller

{
    public $contactService;
    public $contactRepository;
    public function __construct(ContactService $contactService, ContactRepository $contactRepository)
    {
        $this->contact = new Contact;
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
    
    public function allData(){;
        return view('messages', ['data' => $this->contact::All()]);
    }

    public function showOneMessage($id){
        $user = Auth::user()->nickname;

        $this->contactService->transmitUserData($user, $id);

        $postInfo = $this->contactRepository->getInfoFromUser($id);
        return view('OneMessage', ['data' => $postInfo, 'name' => $user]);
    }

    public function updateMessage($id){
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

    public function deleteMessage($id){
        $this->contactRepository->deleteMessage($id);
        return redirect()->route('contactData')->with('success', 'Post delete successful');
    }

    public function getPostByTitle(Request $req){
        $nameOfPost = $req->namePost;
        $this->contactRepository->getPostByTitle($nameOfPost);

        $result = $this->contactRepository->getPostByTitle($nameOfPost);

        if($result->isEmpty()){
            return redirect()->route('contactData')->with('error', 'Post not found');
        }
        else{
            return view('oneTitle', ['data' => $result]);
        }

        // return view('oneTitle', ['data' => $contact]);
    }

    public function showHomePage()
    { 

        $this->contactRepository->getPostedMessages();

        $allData = $this->contactRepository->getPostedMessages();
            
        return view('home', ['data' => $allData]);

    }
    
    public function addMessage($id){
        
        
        $post = Contact::find($id);

        if($post->is_posted){
            return redirect()->route('contactData')->with('error', 'You already posted it');
        }else{
            $post->update(['is_posted' => true]);
        }
        if($post->is_posted = true){
            return redirect('/');
        }
    }
     
    
}
