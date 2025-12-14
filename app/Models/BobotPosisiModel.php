<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BobotPosisiModel extends Model
{
    use HasFactory;
    protected $table = 'bobot_posisi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'posisi_id',
        'kriteria_id',
        'bobot',
        'bobot_wj',
    ];

    public function posisi()
    {
        return $this->belongsTo(PosisiModel::class, 'posisi_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id');
    }

}
