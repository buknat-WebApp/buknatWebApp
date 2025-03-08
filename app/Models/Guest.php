<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

protected $primaryKey = 'id';

protected $table = 'guests';
    
    protected $fillable = [
        'name',
        'school',
        'purpose',
    ];
}
