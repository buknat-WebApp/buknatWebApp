<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_number',
        'grade_and_section',
        'section'
    ];
}
