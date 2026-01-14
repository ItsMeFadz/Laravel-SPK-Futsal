<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BobotPenilaianModel extends Model
{
    use HasFactory;
    protected $table = 'bobot_penilaian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'latihan_id',
        'pemain_id',
        'kriteria_id',
        'bobot',
    ];

    public function pemain()
    {
        return $this->belongsTo(\App\Models\PemainModel::class, 'pemain_id');
    }

    public function latihan()
    {
        return $this->belongsTo(LatihanModel::class, 'latihan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'id');
    }

}
