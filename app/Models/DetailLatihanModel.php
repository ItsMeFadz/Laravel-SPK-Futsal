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
    ];

    public function pemain()
    {
        return $this->belongsTo(\App\Models\PemainModel::class, 'pemain_id');
    }
}
