<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    public $guarded=[];
    public function actors(){
        return $this->belongsToMany("App\actor","actor_movie","movie_id","actor_id");

    }
    public function genre(){
        return $this->belongsTo("App\genre","genre_id");
    }
}
