<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSection extends Model
{
    use HasFactory;

    protected $fillable=[
        'section_name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class,'section_id');
    }

    public function transactionID(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
