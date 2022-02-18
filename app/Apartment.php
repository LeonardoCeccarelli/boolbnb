<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{

    protected $fillable = [
        "title",
        "description",
        "cover_img",
        "rooms",
        "beds",
        "bathrooms",
        "square_metres",
        "night_price",
        "address",
        "city",
        "lat",
        "lon",
        "visible",
    ];

    use SoftDeletes;
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
        return $this->belongsToMany("App\Sponsor")->withPivot('starting_date', 'end_date');
    }

    public function services()
    {
        return $this->belongsToMany("App\Service");
    }
}
