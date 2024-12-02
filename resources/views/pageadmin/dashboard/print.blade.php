<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Triwulan II</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
                @if (!empty($selectedMonths))
                    @foreach ($selectedMonths as $bulan)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endforeach
                @else
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endfor
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($insidenPerBulan as $insiden => $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $insiden }}</td>
                    @if (!empty($selectedMonths))
                        @foreach ($selectedMonths as $bulan)
                            <td>{{ $data[$bulan] }}</td>
                        @endforeach
                    @else
                        @for ($bulan = 1; $bulan <= 12; $bulan++)
                            <td>{{ $data[$bulan] }}</td>
                        @endfor
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>3. Jenis Insiden</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Insiden</th>
                @if (!empty($selectedMonths))
                    @foreach ($selectedMonths as $bulan)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endforeach
                @else
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endfor
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisInsiden as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->jenis_insiden }}</td>
                    @if (!empty($selectedMonths))
                        @foreach ($selectedMonths as $bulan)
                            @if (is_array($jumlahInsidenPerBulan[$item->jenis_insiden][$bulan]))
                                @foreach ($jumlahInsidenPerBulan[$item->jenis_insiden][$bulan] as $jumlah)
                                    <td>{{ $jumlah }}</td>
                                @endforeach
                            @else
                                <td>{{ $jumlahInsidenPerBulan[$item->jenis_insiden][$bulan] }}</td>
                            @endif
                        @endforeach
                    @else
                        @for ($bulan = 1; $bulan <= 12; $bulan++)
                            @if (is_array($jumlahInsidenPerBulan[$item->jenis_insiden][$bulan]))
                                @foreach ($jumlahInsidenPerBulan[$item->jenis_insiden][$bulan] as $jumlah)
                                    <td>{{ $jumlah }}</td>
                                @endforeach
                            @else
                                <td>{{ $jumlahInsidenPerBulan[$item->jenis_insiden][$bulan] }}</td>
                            @endif
                        @endfor
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>4. Menurut Waktu Grading</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Warna</th>
                @if (!empty($selectedMonths))
                    @foreach ($selectedMonths as $bulan)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endforeach
                @else
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endfor
                @endif
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($gradingData) && count($gradingData) > 0)
                @foreach ($gradingData as $no => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span
                                class="badge {{ $item['grading'] == 'Biru'
                                    ? 'badge-primary'
                                    : ($item['grading'] == 'Hijau'
                                        ? 'badge-hijau'
                                        : ($item['grading'] == 'Kuning'
                                            ? 'badge-kuning'
                                            : ($item['grading'] == 'Merah'
                                                ? 'badge-merah'
                                                : ''))) }}">
                                {{ $item['grading'] }}
                            </span>
                        </td>
                        @if (!empty($selectedMonths))
                            @foreach ($selectedMonths as $bulan)
                                <td>{{ $item['data'][$bulan] }}</td>
                            @endforeach
                        @else
                            @for ($bulan = 1; $bulan <= 12; $bulan++)
                                <td>{{ $item['data'][$bulan] }}</td>
                            @endfor
                        @endif
                        <td>{{ array_sum($item['data']) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($selectedMonths) + 4 }}" class="text-center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3>5. Tempat Insiden</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tempat Insiden</th>
                @if (!empty($selectedMonths))
                    @foreach ($selectedMonths as $bulan)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endforeach
                @else
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                    @endfor
                @endif
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($tempatInsidenData) && count($tempatInsidenData) > 0)
                @foreach ($tempatInsidenData as $tempat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tempat['tempat'] }}</td>
                        @if (!empty($selectedMonths))
                            @foreach ($selectedMonths as $bulan)
                                <td>{{ $tempat['bulan'][$bulan] ?? 0 }}</td>
                            @endforeach
                        @else
                            @for ($bulan = 1; $bulan <= 12; $bulan++)
                                <td>{{ $tempat['bulan'][$bulan] ?? 0 }}</td>
                            @endfor
                        @endif
                        <td>{{ $tempat['total'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($selectedMonths) + 4 }}" class="text-center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3>Kesimpulan</h3>
    <p>a. Jumlah seluruh kejadian IKP pada
        @php
            $triwulan = ceil($selectedMonths[0] / 3);
            $namaBulan = implode(
                ' – ',
                array_map(
                    function ($m) {
                        return DateTime::createFromFormat('!m', $m)->format('F');
                    },
                    [$selectedMonths[0], end($selectedMonths)],
                ),
            );

            // Hitung bulan dengan insiden terbanyak
            $maxBulan = $selectedMonths[0];
            $maxTotal = 0;
            foreach ($selectedMonths as $bulan) {
                $total = 0;
                foreach ($jenisInsiden as $jenis) {
                    $total += $jumlahInsidenPerBulan[$jenis->jenis_insiden][$bulan];
                }
                if ($total > $maxTotal) {
                    $maxTotal = $total;
                    $maxBulan = $bulan;
                }
            }
        @endphp
        Triwulan {{ $triwulan }} tahun {{ $selectedYear }} ({{ $namaBulan }}) terjadi sebanyak
        {{ array_sum(array_map(function ($item) {return $item['total'];}, $dataInsiden->toArray())) }} kejadian dengan
        bulan {{ DateTime::createFromFormat('!m', $maxBulan)->format('F') }} menjadi yang paling banyak terjadi
        kejadian IKP yaitu sebanyak {{ $maxTotal }} kejadian.</p>
    <p>b. Dilihat dari jenis kejadian, maka proses kesalahan terkait 
    @php
        $totalKejadian = array_sum(array_map(function($item) { 
            return $item['total']; 
        }, $dataInsiden->toArray()));

        // Mencari jenis insiden dengan jumlah terbanyak
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
    {{ $maxJenisInsiden }} paling banyak yaitu {{ $maxJumlahJenis }} dari {{ $totalKejadian }} kejadian ({{ $persentaseJenis }}%).</p>

    <p>c. Bands terbanyak adalah warna 
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
    {{ $maxGrading }} ada {{ $maxJumlahGrading }} kejadian dari {{ $totalKejadian }} kejadian ({{ $persentaseGrading }}%).</p>

    <p>d. Tempat kejadian terbanyak terjadi di ruang 
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
    {{ $maxTempat }} yaitu {{ $maxJumlahTempat }} kejadian dari jumlah keseluruhan {{ $totalKejadian }} kejadian ({{ $persentaseTempat }}%).</p>

    {{-- <h3>Rekomendasi</h3>
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
    </ul> --}}

    <div style="margin-top: 50px; text-align: center; float: right; width: 250px;">
        <p>Ketua Komite Mutu</p>
        <p>RSUD Kabupaten Temanggung</p>
        <br><br><br>
        <p style="text-decoration: underline;"><strong>drg ASROFI</strong></p>
        <p>NIP. 19770305 200312 1 004</p>
    </div>
</body>

</html>
