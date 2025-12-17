<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailLatihanModel extends Model
{
    use HasFactory;
    protected $table = 'detail_latihan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'latihan_id',
        'pemain_id',
        'status', //01.belum lengkap, 02. sudah lengkap
    ];

    public function pemain()
    {
        return $this->belongsTo(\App\Models\PemainModel::class, 'pemain_id');
    }
}
