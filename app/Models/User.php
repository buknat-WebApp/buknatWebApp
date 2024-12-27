<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Transaction;
use App\Models\BookTransaction;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'id_number',
        'grade_and_section',
        'section',
        'office_or_department',
        'birthdate',
        'contact_number',
        'address',
        'email',
        'password',
        'role',
        'id_pic',
        'avatar',
        'status',
        'last_grade_level',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function books(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(BookTransaction::class, Transaction::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function isLibrarian()
    {
        return User::where('role', 1)->get();
    }

    public function isGraduated()
{
    return $this->role == 3;
}
//    public function isInActive()

//     {

//         return !$this->active;

//     }
}
