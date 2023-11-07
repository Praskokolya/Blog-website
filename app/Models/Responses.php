<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Responses extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'response',
        'user_name',
    ];
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
