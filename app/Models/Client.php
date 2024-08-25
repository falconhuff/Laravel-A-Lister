<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class Client extends Authenticable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function movies(){
        return $this->hasMany(Movie::class);
    }
}
