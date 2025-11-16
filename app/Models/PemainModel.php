<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemainModel extends Model
{
    use HasFactory;
    protected $table = 'pemain';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_pemain',
        'name',
        'jk',
        'kelas',
        'umur',
        'posisi',
        'image',
    ];
}
