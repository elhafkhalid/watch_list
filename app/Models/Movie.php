<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'titre',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lists(){
        return $this->belongsToMany(MyList::class,'list_movie','movie_id','list_id');
    }
}
