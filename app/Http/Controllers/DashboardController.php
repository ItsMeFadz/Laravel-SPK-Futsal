<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use App\Models\LatihanModel;
use App\Models\PemainModel;
use App\Models\PosisiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(){

        $jumlahKriteria = KriteriaModel::count();
        $jumlahPosisi = PosisiModel::count();
        $jumlahPemain = PemainModel::count();
        $jumlahLatihan = LatihanModel::count();

        return view('admin.pages.dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'jumlahKriteria' => $jumlahKriteria,
            'jumlahPosisi' => $jumlahPosisi,
            'jumlahPemain' => $jumlahPemain,
            'jumlahLatihan' => $jumlahLatihan,
        ]);
    }
}
