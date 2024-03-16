<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'merk',
        'slug',
        'nopol',
        'warna',
        'tahun',
        'bbm',
        'penumpang',
        'jenis',
        'deskripsi',
        'harga',
        'status',
        'unggulan',
        'foto'
    ];
    protected $keyType = 'string';
}
