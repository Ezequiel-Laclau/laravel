<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    public $timestamps=false;
    public $guarded=[];
    public function movies(){
        return $this->hasMany("App\movie","genre_id");
    }
}
