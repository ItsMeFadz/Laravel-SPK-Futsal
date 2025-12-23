<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 11px;
        }

        .center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background: #ddd;
        }

        hr {
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="center">
        <img src="{{ public_path('assets/img/logo/logo-SMA.jpeg') }}" width="70">
        <h3>SMA NEGERI 1 DUKUPUNTANG</h3>
        <hr>
    </div>

    <!-- TITLE -->
    <h3 class="center">HASIL REKOMENDASI LINE UP FUTSAL</h3>

    <!-- PENILAIAN PEMAIN -->
    <h4>Penilaian Pemain</h4>
    <table>
        <tr>
            <th>Alternatif</th>
            @foreach ($kriteria as $k)
                <th>{{ $k->kode }}</th>
            @endforeach
        </tr>
        @foreach ($pemain as $p)
            <tr>
                <td>{{ $p->kode_pemain }}</td>
                @foreach ($kriteria as $k)
                    <td class="center">{{ number_format($matrixX[$p->id][$k->id]) }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    <!-- RANKING -->
    <h4>Perangkingan</h4>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Vi</th>
            <th>Rank</th>
        </tr>
        @foreach ($ranking as $r)
            <tr>
                <td>{{ $r['pemain']->kode_pemain }}</td>
                <td>{{ $r['pemain']->name }}</td>
                <td>{{ $r['pemain']->posisi->name }}</td>
                <td class="center">{{ number_format($r['nilai'], 4) }}</td>
                <td class="center">{{ $r['rank'] }}</td>
            </tr>
        @endforeach
    </table>

    <!-- HASIL REKOMENDASI -->
    <h4>Hasil Rekomendasi Line Up</h4>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Vi</th>
            <th>Rank</th>
        </tr>
        @foreach ($lineUp as $item)
            <tr>
                <td>{{ $item['pemain']->kode_pemain }}</td>
                <td>{{ $item['pemain']->name }}</td>
                <td>{{ $item['pemain']->posisi->name }}</td>
                <td class="center">{{ number_format($item['nilai'], 4) }}</td>
                <td class="center">{{ $item['rank'] }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
