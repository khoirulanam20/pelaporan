<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { 
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
            font-family: "Times New Roman", Times, serif;
        }
        th, td { 
            border: 1px solid black; 
            padding: 5px; 
            text-align: left;
            font-family: "Times New Roman", Times, serif;
        }
        th { 
            background-color: #f0f0f0; 
        }
        h1, h2, h3 { 
            margin-top: 20px; 
            font-family: "Times New Roman", Times, serif;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            font-family: "Times New Roman", Times, serif;
        }
        .signature { 
            margin-top: 50px; 
            text-align: right; 
            width: 250px;
            float: right;
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN EVALUASI IKP TAHUN {{ $selectedYear }}</h2>
        <h2>{{ strtoupper($dataInsiden[0]['periode']) }}</h2>
    </div>

    <h3>1. Jumlah Kejadian</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Bulan</th>
                <th>Jumlah Insiden</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataInsiden as $insiden)
                <tr>
                    <td>{{ $insiden['no'] }}</td>
                    <td>{{ $insiden['periode'] }}</td>
                    <td>{{ $insiden['bulan'] }}</td>
                    <td>{{ $insiden['jumlah_insiden'] }}</td>
                    <td>{{ $insiden['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>2. Jenis Insiden</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Insiden</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
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
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>3. Menurut Waktu Grading</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Warna</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gradingData as $no => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['grading'] }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $item['data'][$bulan] }}</td>
                    @endforeach
                    <td>{{ array_sum($item['data']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>4. Tempat Insiden</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tempat Insiden</th>
                @foreach ($selectedMonths as $bulan)
                    <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tempatInsidenData as $tempat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tempat['tempat'] }}</td>
                    @foreach ($selectedMonths as $bulan)
                        <td>{{ $tempat['bulan'][$bulan] ?? 0 }}</td>
                    @endforeach
                    <td>{{ $tempat['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

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

    <h3>Rekomendasi</h3>
    <ul>
        <li>Penguatan edukasi pada pasien risiko jatuh</li>
        <li>Pengusulan bel pasien untuk ruang transit</li>
        <li>Pengusulan ulang leaflet resiko jatuh dengan pemilihan kata kata yang tepat dan mudah di pahami</li>
        <li>Penguatan edukasi pada pasien resiko jatuh</li>
        <li>Penekanan edukasi untuk menggunakan sandal yang tidak licin</li>
        <li>Memfungsikan pegangan kamar mandi untuk pegangan bukan tempat urinal dan pispot</li>
        <li>Pengusulan pembuatan Rak untuk tempat Pispot dan Urinal</li>
        <li>Lakukan Monev pembersihan kamar mandi yang dilakukan oleh Cleaning service</li>
        <li>Adanya Supervisor untuk memantau pekerjaan cleaning service ( Bidang penunjang dan sanitasi )</li>
        <li>Refresh kepada Cleaning service terkait SPO pembersihan kamar mandi dll</li>
        <li>Pengusulan ceck list untuk evaluasi pekerjaan Cleaning service</li>
        <li>Kaji ulang terkait SPO Rekonsiliasi obat</li>
        <li>Pengusulan bel pasien untuk ruang transit</li>
        <li>Koordinasi dengan farmasi terkait retur obat dan dispensing</li>
        <li>Pengusulan pembuatan barcode untuk penggunaan alat</li>
        <li>Follow up jadwal kalibrasi alat</li>
        <li>Koordinasikan dengan farmasi terkait jadwal visitasi ke ruangan</li>
    </ul>

    <div class="signature">
        <p>Ketua Komite Mutu</p>
        <p>RSUD Kabupaten Temanggung</p>
        <br><br><br>
        <p style="text-decoration: underline;"><strong>drg ASROFI</strong></p>
        <p>NIP. 19770305 200312 1 004</p>
    </div>
</body>
</html>
