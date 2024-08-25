<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'path', 'description', 'client_id', 'edited_by'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function editor(){
        return $this->belongsTo(Client::class, 'edited_by');
    }
}
