<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brt extends Model
{
    // Allowing mass assignment for specific fields
    protected $fillable = [
        'brt_code',
        'reserved_amount',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
