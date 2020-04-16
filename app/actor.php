<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    public $guarded=[];
    public function movies(){
        return $this->belongsToMany("App\movie","actor_movie","actor_id","movie_id");

    }
}
