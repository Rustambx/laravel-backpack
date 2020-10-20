<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'price'];

    public function authors ()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function getAuthorsNameAttribute ()
    {
        $arAuthorsName = [];
        $authors = $this->authors;
        foreach ($authors as $author) {
            $arAuthorsName[] = $author->name;
        }
        return implode(', ', $arAuthorsName);
    }
}
