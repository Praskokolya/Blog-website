<?php

namespace App\Http\View\Composers;

use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\View\View;

class FeedComposer
{
    public const PATH_TO_PHOTO = 'photos/without_picture.png';
    public const NOT_STATED = 'Not stated';
    public function compose(View $view)
    {
        $data = $view->getData();
        $images = $data['data']->pluck('userInfos.0.image');

        foreach ($images as $key => $item) {
            if ($item === null) {
                $data['data'][$key]->userInfos[0]->image = self::PATH_TO_PHOTO;
            }
        }

        $genders = $data['data']->pluck('userInfos.0.gender');
        foreach ($genders as $key => $gender) {
            if ($gender === null) {
                $data['data'][$key]->userInfos[0]->gender = self::NOT_STATED;
            }
        }

        $interests = $data['data']->pluck('userInfos.0.interests');
        foreach ($interests as $key => $interest) {
            if ($interest === null) {
                $data['data'][$key]->userInfos[0]->interests = self::NOT_STATED;
            }
        }
    }
}
