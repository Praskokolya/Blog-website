<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'message', 'is_posted', 'user_id'];

    public function RegistredUser(): BelongsTo
    {
        return $this->belongsTo(RegistredUsers::class, 'user_id', 'id');
    }
    public function Responses()
    {
        return $this->hasMany(Responses::class);
    }
}
