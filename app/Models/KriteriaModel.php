<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KriteriaModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode',
        'name',
        'bobot',
        'atribut',
    ];

    public function bobotKriteria()
    {
        return $this->hasMany(BobotPosisiModel::class, 'posisi_id');
    }

    public function bobotPerPosisi()
    {
        return $this->hasMany(BobotPosisiModel::class, 'kriteria_id');
    }

}
