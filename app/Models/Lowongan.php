<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function perusahaan() {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function alumni() {
        return $this->belongsTo(Alumni::class, 'alumni_nisn');
    }
}
