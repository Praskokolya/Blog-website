<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\posts;
class ContactController extends Controller



{
    public function __construct()
    {
        $this->middleware('auth')->only('allData');
    }
    

    public function submit(ContactRequest $req)

    {
        $contact = new Contact();
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();
        
        return view('home', ['data' => $contact]);

    }
    
    public function allData(){;
        $this->middleware('auth');
        $contact = new Contact;
        return view('messages', ['data' => Contact::All()]);
    }

    public function showOneMessage($id){
        $contact = new Contact;
        return view('oneMessage',  ['data' => $contact->find($id)]);
    }

    public function updateMessage($id){
        $contact = new Contact;
        return view('update',  ['data' => $contact->find($id)]);
    }

    public function updateMessageSubmit($id, ContactRequest $req)
    {
        
        $contact = Contact::find($id);
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();
        
        return redirect()->route('contactDataOne', $id)->with('success', 'Сообещние было обновлено!');
    }

    public function deleteMessage($id){
        $contact = Contact::find($id);
        $contact->delete();
        posts::where('idPost', $id)->delete();
        return redirect()->route('contactData')->with('success', 'Сообещние было удалено!');
    }

    public function getPostByTitle(Request $req){
        $nameOfPost = $req->namePost;
        
        $contact = Contact::where('subject', $nameOfPost)->get();
        
        if ($contact->isEmpty()) {
            return redirect()->route('contactData')->with('error', 'Записи не найдены');
        }
        
        return view('oneTitle', ['data' => $contact]);
    }

    public function showHomePage()
    {
        $allPosts = posts::all();
    
        return view('home', ['data' => $allPosts]);
    }
    public function addMessage($id){
        $post = Contact::find($id);
        posts::create([
            'idPost' => $post->id,
            'subject' => $post->subject,
            'message' => $post->message,
            'email' => $post->email,
        ]);
        return redirect()->route('home');
    }
     
    
}
