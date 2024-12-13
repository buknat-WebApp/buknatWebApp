<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'book_id',
        'borrowed_book_condition',
        'returned_at',
        'return_book_condition',
        'fines',
        'remarks',

    ];

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
