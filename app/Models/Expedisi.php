<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedisi extends Model
{
    use HasFactory;
    protected $table = 'expedisi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'slug',
        'judul',
        'deskripsi'
    ];
}
