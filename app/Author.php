<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use CrudTrait;

    protected $fillable = ['name'];

    public function books ()
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }
}
