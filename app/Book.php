<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    //
	use Sortable;
    
    protected $fillable = ['title', 'author_id', 'publication_date', 'translations'];

    public $sortable = ['title','author_id','translations'];

    public function author()
    {
    	return $this->belongsTo('App\Author');
    }
}
