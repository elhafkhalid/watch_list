<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    protected $table = 'lists';
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function movies(){
        return $this->belongsToMany(Movie::class,'list_movie','list_id','movie_id');
    }
}
