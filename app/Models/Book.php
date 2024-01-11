<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'book_title',
        'author_id',
        'section_id',
        'location_id',
//        'class_id',
        'class_no',
        'edition',
        'publication_year',
        'date_acquired',
        'no_of_copies',
        'on_hand_per_count',
        'book_status',
        'book_condition',
        'isbn',
        'publisher',
        'genre',
        'language',
        'number_of_pages',
        'summary',
        'added_by',
        'available_copies'
    ];

    public function bookTransactions()
    {
        return $this->hasMany(BookTransaction::class, 'book_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function section()
    {
        return $this->belongsTo(BookSection::class, 'section_id');
    }
    public function location()
    {
        return $this->belongsTo(BookLocation::class, 'location_id');
    }


    //   public function transactions()
    // {
    //     return $this->belongsToMany(BookTransaction::class);
    // }
}
