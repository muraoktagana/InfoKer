<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

     // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'nisn';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $guarded=[];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lowongan() {
        return $this->hasMany(Lowongan::class, 'alumni_nisn');
    }
}
