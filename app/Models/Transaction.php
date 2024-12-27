<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'expected_return_date',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookTransactions() {
        return $this->hasMany(BookTransaction::class, 'transaction_id');
    }


}
