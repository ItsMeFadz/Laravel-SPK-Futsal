<?php

namespace App\Http\Controllers;

use App\Models\LatihanModel;
use App\Models\PemainModel;
use App\Models\KriteriaModel;
use App\Models\BobotPenilaianModel;
use App\Models\BobotPosisiModel;

class PerhitunganController extends Controller
{
    public function index()
    {
        $pemain = PemainModel::with('posisi')->get();
        $kriteria = KriteriaModel::all();

        /**
         * =========================
         * 1. MATRIX KEPUTUSAN (X)
         * =========================
         */
        $matrixX = [];

        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $matrixX[$p->id][$k->id] =
                    BobotPenilaianModel::where('pemain_id', $p->id)
                        ->where('kriteria_id', $k->id)
                        ->value('bobot') ?? 0;
            }
        }

        /**
         * =========================
         * 2. NORMALISASI R
         * =========================
         */
        $pembagi = [];
        foreach ($kriteria as $k) {
            $sum = 0;
            foreach ($pemain as $p) {
                $sum += pow($matrixX[$p->id][$k->id], 2);
            }
            $pembagi[$k->id] = sqrt($sum);
        }

        $matrixR = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $matrixR[$p->id][$k->id] =
                    $pembagi[$k->id] == 0 ? 0 :
                    $matrixX[$p->id][$k->id] / $pembagi[$k->id];
            }
        }

        /**
         * =========================
         * 3. NORMALISASI Y (WP)
         * =========================
         */
        $latihanTerbaru = LatihanModel::orderBy('tanggal', 'desc')->first();
        $penilaian = BobotPenilaianModel::where('latihan_id', $latihanTerbaru->id)
            ->get()
            ->groupBy(['pemain_id', 'kriteria_id']);
        $matrixY = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {

                $bobotWj = BobotPosisiModel::where('posisi_id', $p->id_posisi)
                    ->where('kriteria_id', $k->id)
                    ->value('bobot_wj') ?? 0;

                $nilaiLatihan = $penilaian[$p->id][$k->id][0]->bobot ?? 0;

                $matrixY[$p->id][$k->id] =
                    $nilaiLatihan * $bobotWj;
            }
        }

        /**
         * =========================
         * 4. A+ dan A-
         * =========================
         */
        $Aplus = [];
        $Amin = [];

        foreach ($kriteria as $k) {
            $col = array_column($matrixY, $k->id);

            if ($k->atribut === 1) {
                $Aplus[$k->id] = max($col);
                $Amin[$k->id] = min($col);
            } else {
                $Aplus[$k->id] = min($col);
                $Amin[$k->id] = max($col);
            }
        }

        /**
         * =========================
         * 5. JARAK D+ dan D-
         * =========================
         */
        $Dplus = [];
        $Dmin = [];

        foreach ($pemain as $p) {
            $sumPlus = 0;
            $sumMin = 0;

            foreach ($kriteria as $k) {
                $sumPlus += pow($matrixY[$p->id][$k->id] - $Aplus[$k->id], 2);
                $sumMin += pow($matrixY[$p->id][$k->id] - $Amin[$k->id], 2);
            }

            $Dplus[$p->id] = sqrt($sumPlus);
            $Dmin[$p->id] = sqrt($sumMin);
        }

        /**
         * =========================
         * 6. NILAI PREFERENSI
         * =========================
         */
        $preferensi = [];
        foreach ($pemain as $p) {
            $preferensi[$p->id] =
                ($Dplus[$p->id] + $Dmin[$p->id]) == 0 ? 0 :
                $Dmin[$p->id] / ($Dplus[$p->id] + $Dmin[$p->id]);
        }

        /**
         * =========================
         * 7. PERANGKINGAN
         * =========================
         */
        $ranking = [];

        foreach ($pemain as $p) {
            $ranking[] = [
                'pemain' => $p,
                'nilai' => $preferensi[$p->id]
            ];
        }

        usort($ranking, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // Tambah ranking (AMAN)
        foreach ($ranking as $i => $r) {
            $ranking[$i]['rank'] = $i + 1;
        }

        /**
         * =========================
         * 8. REKOMENDASI LINE UP
         * =========================
         */
        $lineUp = [];

        foreach ($ranking as $r) {
            $posisi = $r['pemain']->id_posisi;

            // Ambil pemain terbaik pertama per posisi
            if (!isset($lineUp[$posisi])) {
                $lineUp[$posisi] = $r;
            }
        }



        /**
         * =========================
         * RETURN VIEW
         * =========================
         */
        return view('admin.pages.perhitungan.index', [
            'title' => 'Perhitungan',
            'active' => 'Perhitungan',
            'pemain' => $pemain,
            'kriteria' => $kriteria,
            'matrixX' => $matrixX,
            'matrixR' => $matrixR,
            'matrixY' => $matrixY,
            'Aplus' => $Aplus,
            'Amin' => $Amin,
            'Dplus' => $Dplus,
            'Dmin' => $Dmin,
            'preferensi' => $preferensi,
            'ranking' => $ranking,
            'pembagi' => $pembagi,
            'lineUp' => $lineUp,
        ]);
    }

}