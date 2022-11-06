<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'year_published',
        'edition',
        'isbn_10',
        'isbn_13',
        'height',
        'on_loan',
        'genre',
        'sub_genre',
    ];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function publishers(){
        return $this->hasMany(Publisher::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
}
