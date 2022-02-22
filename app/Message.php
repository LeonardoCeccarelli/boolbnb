<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "name",
        "email",
        "object",
        "content",
    ];

    public function apartment()
    {
        return $this->belongsTo("App\Apartment");
    }
}
