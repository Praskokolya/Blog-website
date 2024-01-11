<?php

namespace App\Http\View\Composers;

use App\Repositories\ContactRepository;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $data = $view->getData();
        $interests = $data['data']->first()->interests;
        $image = $data['data']->first()->image;
        $gender = $data['data']->first()->gender;
        $birthdate = $data['data']->first()->birthdate;

        if ($interests == null) {
            $data['data']->first()->interests = 'Not stated';
        }
        if ($image == null) {
            $data['data']->first()->image = 'photos/without_picture.png';
        }

        if ($gender == null) {
            $data['data']->first()->gender = 'Not stated';
        }
        if ($birthdate == null) {
            $data['data']->first()->birthdate = 'Not stated';
        }
    }
}
