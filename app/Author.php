<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = ['first_name', 'last_name', 'country', 'user_id'];

    public function book()
    {
    	return $this->hasOne('App\Book');
    }
}
