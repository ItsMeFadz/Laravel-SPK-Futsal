<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LatihanModel extends Model
{
    use HasFactory;
    protected $table = 'latihan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'tanggal',
    ];
}
