<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function visualisations()
    {
        return $this->hasMany("App\Visualisation");
    }

    public function messages()
    {
        return $this->hasMany("App\Message");
    }

    public function images()
    {
        return $this->hasMany("App\Image");
    }

    public function sponsor()
    {
        return $this->belongsToMany("App\Sponsor");
    }

    public function services()
    {
        return $this->belongsToMany("App\Service");
    }
}
