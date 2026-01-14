<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosisiModel extends Model
{
    use HasFactory;
    protected $table = 'posisi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function bobotPosisi()
    {
        return $this->hasMany(BobotPosisiModel::class, 'kriteria_id');
    }

    public function pemain()
    {
        return $this->hasMany(PemainModel::class, 'id_posisi', 'id');
    }


}
