<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    protected $casts = [
        'date_to_be_sent' => 'datetime',
    ];

    

    use HasFactory;

    // Define the relationship back to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
