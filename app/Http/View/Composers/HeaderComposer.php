<?php

namespace App\Http\View\Composers;

use App\Repositories\ContactRepository;
use Illuminate\View\View;

class HeaderComposer{

    public $contactRepository;

    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }
    public function compose(View $view)
    {
        $data = $this->contactRepository->getUserImage();
        if($data == null){
            $data = 'photos/without_picture.png';
        }
        $view->with('headerImage', $data);

    }
}