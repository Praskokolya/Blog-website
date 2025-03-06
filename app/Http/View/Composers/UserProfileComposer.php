<?php

namespace App\Http\View\Composers;

 use Illuminate\View\View;

class UserProfileComposer{
     
    const NOTSTATED = 'photos/without_picture.png';
    public function compose(View $view)
    {
        $data = $view->getData();

         if ($data['data']->userInfos[0]->image == null) {
            $data['data']->userInfos[0]->image = self::NOTSTATED;
        }
    }
}