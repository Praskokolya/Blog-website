<?php

namespace App\Observers;

use App\Events\UserCreating;
use App\Models\RegistredUsers;

class RegistredUsersObserver
{
    /**
     * Handle the RegistredUsers "created" event.
     *
     * @param  \App\Models\RegistredUsers  $registredUsers
     * @return void
     */
    public function creating (RegistredUsers $registredUsers)
    {
        event(new UserCreating(''));
    }

    /**
     * Handle the RegistredUsers "updated" event.
     *
     * @param  \App\Models\RegistredUsers  $registredUsers
     * @return void
     */
    public function updated(RegistredUsers $registredUsers)
    {
        //
    }

    /**
     * Handle the RegistredUsers "deleted" event.
     *
     * @param  \App\Models\RegistredUsers  $registredUsers
     * @return void
     */
    public function deleted(RegistredUsers $registredUsers)
    {
        //
    }

    /**
     * Handle the RegistredUsers "restored" event.
     *
     * @param  \App\Models\RegistredUsers  $registredUsers
     * @return void
     */
    public function restored(RegistredUsers $registredUsers)
    {
        //
    }

    /**
     * Handle the RegistredUsers "force deleted" event.
     *
     * @param  \App\Models\RegistredUsers  $registredUsers
     * @return void
     */
    public function forceDeleted(RegistredUsers $registredUsers)
    {
        //
    }
}
