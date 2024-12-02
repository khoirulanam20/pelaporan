<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }

        .badge-merah {
            background-color: #dc3545;
            color: white;
        }

        .badge-kuning {
            background-color: #ffc107;
            color: black;
        }

        .badge-hijau {
            background-color: #28a745;
            color: white;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
            float: right;
            width: 250px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN EVALUASI IKP TAHUN {{ $selectedYear }}</h2>
        <h2>{{ strtoupper($dataInsiden[0]['periode']) }}</h2>
    </div>

    <h3>1. Jumlah Kejadian</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Bulan</th>
                <th>Jumlah Insiden</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalInsiden = 0;
            @endphp
            @foreach ($dataInsiden as $insiden)
                @php
                    $totalInsiden += $insiden['jumlah_insiden'];
                @endphp
                <tr>
                    <td>{{ $insiden['no'] }}</td>
                    <td>{{ $insiden['periode'] }}</td>
                    <td>{{ $insiden['bulan'] }}</td>
                    <td>{{ $insiden['jumlah_insiden'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: center; font-weight: bold;">Total</td>
                <td style="font-weight: bold;">{{ $totalInsiden }}</td>
            </tr>
        </tbody>
    </table>

    <h3>2. Insiden</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Insiden</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insidenPerBulan as $insiden => $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $insiden }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $data[$bulan] }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ array_sum($data) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($selectedMonths) + 2 }}" style="text-align: center; font-weight: bold;">Total</td>
                <td style="font-weight: bold;">{{ $totalInsiden }}</td>
            </tr>
        </tbody>
    </table>

    <h3>3. Jenis Insiden</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Insiden</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisInsiden as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->jenis_insiden }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $jumlahInsidenPerBulan[$item->jenis_insiden][$bulan] }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ array_sum($jumlahInsidenPerBulan[$item->jenis_insiden]) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($selectedMonths) + 2 }}" style="text-align: center; font-weight: bold;">Total</td>
                <td style="font-weight: bold;">{{ $totalInsiden }}</td>
            </tr>
        </tbody>
    </table>

    <h3>4. Menurut Waktu Grading</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Warna</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPerBulan = array_fill(1, 12, 0);
                $grandTotal = 0;
            @endphp
            @foreach ($gradingData as $no => $item)
                @php
                    $rowTotal = array_sum($item['data']);
                    $grandTotal += $rowTotal;
                    foreach($selectedMonths as $bulan) {
                        $totalPerBulan[$bulan] += $item['data'][$bulan];
                    }
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['grading'] }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $item['data'][$bulan] }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ $rowTotal }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($selectedMonths) + 2 }}" style="text-align: center; font-weight: bold;">Total</td>
                <td style="font-weight: bold;">{{ $grandTotal }}</td>
            </tr>
        </tbody>
    </table>

    <h3>5. Tempat Insiden</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tempat Insiden</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPerBulan = array_fill(1, 12, 0);
                $grandTotal = 0;
            @endphp
            @foreach ($tempatInsidenData as $tempat)
                @php
                    $rowTotal = array_sum($tempat['bulan']);
                    $grandTotal += $rowTotal;
                    foreach($selectedMonths as $bulan) {
                        $totalPerBulan[$bulan] += $tempat['bulan'][$bulan] ?? 0;
                    }
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tempat['tempat'] }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $tempat['bulan'][$bulan] ?? 0 }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ $rowTotal }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($selectedMonths) + 2 }}" style="text-align: center; font-weight: bold;">Total</td>
                <td style="font-weight: bold;">{{ $grandTotal }}</td>
            </tr>
        </tbody>
    </table>

    <div class="kesimpulan">
        <h3>Kesimpulan</h3>
        @php
            $triwulan = ceil($selectedMonths[0] / 3);
            $namaBulan = implode(' – ', array_map(function($m) {
                return DateTime::createFromFormat('!m', $m)->format('F');
            }, [$selectedMonths[0], end($selectedMonths)]));
            
            $maxBulan = $selectedMonths[0];
            $maxTotal = 0;
            foreach($selectedMonths as $bulan) {
                $total = 0;
                foreach($jenisInsiden as $jenis) {
                    $total += $jumlahInsidenPerBulan[$jenis->jenis_insiden][$bulan];
                }
                if($total > $maxTotal) {
                    $maxTotal = $total;
                    $maxBulan = $bulan;
                }
            }

            $totalKejadian = array_sum(array_map(function($item) { 
                return $item['total']; 
            }, $dataInsiden->toArray()));
        @endphp

        <p>a. Jumlah seluruh kejadian IKP pada Triwulan {{ $triwulan }} tahun {{ $selectedYear }} ({{ $namaBulan }}) 
           terjadi sebanyak {{ $totalKejadian }} kejadian dengan bulan {{ DateTime::createFromFormat('!m', $maxBulan)->format('F') }} 
           menjadi yang paling banyak terjadi kejadian IKP yaitu sebanyak {{ $maxTotal }} kejadian.</p>

        @php
            $maxJenisInsiden = '';
            $maxJumlahJenis = 0;
            foreach($jenisInsiden as $jenis) {
                $total = 0;
                foreach($selectedMonths as $bulan) {
                    $total += $jumlahInsidenPerBulan[$jenis->jenis_insiden][$bulan];
                }
                if($total > $maxJumlahJenis) {
                    $maxJumlahJenis = $total;
                    $maxJenisInsiden = $jenis->jenis_insiden;
                }
            }
            $persentaseJenis = $totalKejadian > 0 ? round(($maxJumlahJenis / $totalKejadian) * 100, 2) : 0;
        @endphp

        <p>b. Dilihat dari jenis kejadian, maka proses kesalahan terkait {{ $maxJenisInsiden }} 
           paling banyak yaitu {{ $maxJumlahJenis }} dari {{ $totalKejadian }} kejadian ({{ $persentaseJenis }}%).</p>

        @php
            $maxGrading = '';
            $maxJumlahGrading = 0;
            foreach($gradingData as $grading => $data) {
                $totalGrading = array_sum($data['data']);
                if($totalGrading > $maxJumlahGrading) {
                    $maxJumlahGrading = $totalGrading;
                    $maxGrading = $grading;
                }
            }
            $persentaseGrading = $totalKejadian > 0 ? round(($maxJumlahGrading / $totalKejadian) * 100, 2) : 0;
        @endphp

        <p>c. Bands terbanyak adalah warna {{ $maxGrading }} ada {{ $maxJumlahGrading }} 
           kejadian dari {{ $totalKejadian }} kejadian ({{ $persentaseGrading }}%).</p>

        @php
            $maxTempat = '';
            $maxJumlahTempat = 0;
            foreach($tempatInsidenData as $tempat) {
                if($tempat['total'] > $maxJumlahTempat) {
                    $maxJumlahTempat = $tempat['total'];
                    $maxTempat = $tempat['tempat'];
                }
            }
            $persentaseTempat = $totalKejadian > 0 ? round(($maxJumlahTempat / $totalKejadian) * 100, 2) : 0;
        @endphp

        <p>d. Tempat kejadian terbanyak terjadi di ruang {{ $maxTempat }} 
           yaitu {{ $maxJumlahTempat }} kejadian dari jumlah keseluruhan {{ $totalKejadian }} 
           kejadian ({{ $persentaseTempat }}%).</p>
    </div>

    <div class="rekomendasi">
        <h3>Rekomendasi</h3>
        <ul>
            <li>Isi rekomendasi disini</li>
        </ul>
    </div>

    <div class="signature" style="margin-top: 50px; text-align: center; float: right; width: 250px;">
        <p>Ketua Komite Mutu</p>
        <p>RSUD Kabupaten Temanggung</p>
        <br><br><br>
        <p style="text-decoration: underline;"><strong>drg ASROFI</strong></p>
        <p>NIP. 19770305 200312 1 004</p>
    </div>
</body>
</html>
