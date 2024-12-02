<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insiden;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        session()->forget('selectedMonths');
        session()->forget('selectedYear');

        $selectedMonths = range(1, 12);
        $selectedYear = date('Y');

        $insiden = Insiden::whereYear('waktu_insiden', $selectedYear)->get();
        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();

        $dataPerJenisPerBulan = [];

        foreach ($jenisInsiden as $jenis) {
            $dataPerJenisPerBulan[$jenis->jenis_insiden] = array_fill(1, 12, 0);

            $insidenPerBulan = Insiden::select(
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
                ->where('jenis_insiden', $jenis->jenis_insiden)
                ->whereYear('waktu_insiden', $selectedYear)
                ->groupBy('bulan')
                ->get();

            foreach ($insidenPerBulan as $data) {
                $dataPerJenisPerBulan[$jenis->jenis_insiden][$data->bulan] = $data->total;
            }
        }

        $insidenTotal = Insiden::select(
            DB::raw('MONTH(waktu_insiden) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('waktu_insiden', $selectedYear)
            ->groupBy('bulan')
            ->get();

        $dataPerBulan = [
            'biru' => array_fill(1, 12, 0),
            'merah' => array_fill(1, 12, 0),
            'total' => array_fill(1, 12, 0)
        ];

        foreach ($insidenTotal as $item) {
            $dataPerBulan['total'][$item->bulan] = $item->total;
        }

        $currentMonth = date('m');
        $currentYear = date('Y');

        $lastMonth = date('m', strtotime('-1 month'));
        $lastMonthYear = $lastMonth == 12 ? $currentYear - 1 : $currentYear;

        setlocale(LC_TIME, 'id_ID');
        $lastMonthName = strftime('%B', strtotime("$lastMonthYear-$lastMonth-01"));

        $insidenBulanIni = Insiden::whereMonth('waktu_insiden', $currentMonth)
            ->whereYear('waktu_insiden', $currentYear)
            ->count();

        $insidenBulanLalu = Insiden::whereMonth('waktu_insiden', $lastMonth)
            ->whereYear('waktu_insiden', $lastMonthYear)
            ->count();

        $percentage = $insidenBulanLalu > 0
            ? round((($insidenBulanIni - $insidenBulanLalu) / $insidenBulanLalu) * 100, 2)
            : 0;

        $monthlyData = [
            'month' => $insidenBulanIni,
            'percentage' => $percentage . '%',
            'lastMonth' => $lastMonthName,
            'lastMonthTotal' => $insidenBulanLalu
        ];

        $insidenPerRuangan = Insiden::with('ruanganRelasi')
            ->select('ruangan', DB::raw('count(*) as total'))
            ->groupBy('ruangan')
            ->get();

        $warnaGrading = DB::table('insiden')
            ->select(
                'grading',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('grading', 'bulan')
            ->orderBy('grading')
            ->get();

        // Menyusun ulang data untuk tampilan
        $gradingData = [];
        $gradings = ['Biru', 'Hijau', 'Kuning', 'Merah'];

        foreach ($gradings as $grading) {
            $gradingData[$grading] = [
                'grading' => $grading,
                'data' => array_fill(1, 12, 0)
            ];
        }

        foreach ($warnaGrading as $data) {
            if (isset($gradingData[$data->grading])) {
                $gradingData[$data->grading]['data'][$data->bulan] = $data->total;
            }
        }

        return view('pageadmin.dashboard.index', [
            'insiden' => $insiden,
            'jenisInsiden' => $jenisInsiden,
            'dataPerJenisPerBulan' => $dataPerJenisPerBulan,
            'dataInsiden' => [
                'biru' => array_values($dataPerBulan['biru']),
                'merah' => array_values($dataPerBulan['merah']),
                'total' => array_values($dataPerBulan['total'])
            ],
            'monthlyData' => $monthlyData,
            'selectedMonths' => $selectedMonths,
            'selectedYear' => $selectedYear,
            'insidenPerRuangan' => $insidenPerRuangan,
            'gradingData' => $gradingData
        ]);
    }

    public function filter(Request $request)
    {
        $selectedMonths = $request->months ?? [];
        $selectedYear = $request->year ?? date('Y');

        // Simpan filter ke session
        session(['selectedMonths' => $selectedMonths]);
        session(['selectedYear' => $selectedYear]);

        // Validasi tahun
        if (!is_numeric($selectedYear) || $selectedYear < 2000 || $selectedYear > 2100) {
            return response()->json([
                'error' => 'Tahun tidak valid'
            ], 400);
        }

        $insiden = Insiden::whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->whereYear('waktu_insiden', $selectedYear)
            ->get();

        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();

        $dataPerJenisPerBulan = [];

        foreach ($jenisInsiden as $jenis) {
            $dataPerJenisPerBulan[$jenis->jenis_insiden] = array_fill(1, 12, 0);

            $insidenPerBulan = Insiden::select(
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
                ->where('jenis_insiden', $jenis->jenis_insiden)
                ->whereYear('waktu_insiden', $selectedYear)
                ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
                ->groupBy('bulan')
                ->get();

            foreach ($insidenPerBulan as $data) {
                $dataPerJenisPerBulan[$jenis->jenis_insiden][$data->bulan] = $data->total;
            }
        }

        $insidenTotal = Insiden::select(
            DB::raw('MONTH(waktu_insiden) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereIn(DB::raw('YEAR(waktu_insiden)'), [date('Y'), date('Y', strtotime('+1 year'))])
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('bulan')
            ->get();

        $dataPerBulan = [
            'biru' => array_fill(1, 12, 0),
            'merah' => array_fill(1, 12, 0),
            'total' => array_fill(1, 12, 0)
        ];

        foreach ($insidenTotal as $item) {
            $dataPerBulan['total'][$item->bulan] = $item->total;
        }

        $currentMonth = date('m');
        $currentYear = date('Y');

        $lastMonth = date('m', strtotime('-1 month'));
        $lastMonthYear = $lastMonth == 12 ? $currentYear - 1 : $currentYear;

        setlocale(LC_TIME, 'id_ID');
        $lastMonthName = strftime('%B', strtotime("$lastMonthYear-$lastMonth-01"));

        $insidenBulanIni = Insiden::whereMonth('waktu_insiden', $currentMonth)
            ->whereYear('waktu_insiden', $currentYear)
            ->count();

        $insidenBulanLalu = Insiden::whereMonth('waktu_insiden', $lastMonth)
            ->whereYear('waktu_insiden', $lastMonthYear)
            ->count();

        $percentage = $insidenBulanLalu > 0
            ? round((($insidenBulanIni - $insidenBulanLalu) / $insidenBulanLalu) * 100, 2)
            : 0;

        $monthlyData = [
            'month' => $insidenBulanIni,
            'percentage' => $percentage . '%',
            'lastMonth' => $lastMonthName,
            'lastMonthTotal' => $insidenBulanLalu
        ];

        $insidenPerRuangan = Insiden::with('ruanganRelasi')
            ->select('ruangan', DB::raw('count(*) as total'))
            ->groupBy('ruangan')
            ->get();    

        $warnaGrading = DB::table('insiden')
            ->select(
                'grading',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('grading', 'bulan')
            ->orderBy('grading')
            ->get();

        // Menyusun ulang data untuk tampilan
        $gradingData = [];
        $gradings = ['Biru', 'Hijau', 'Kuning', 'Merah'];

        foreach ($gradings as $grading) {
            $gradingData[$grading] = [
                'grading' => $grading,
                'data' => array_fill(1, 12, 0)
            ];
        }

        foreach ($warnaGrading as $data) {
            if (isset($gradingData[$data->grading])) {
                $gradingData[$data->grading]['data'][$data->bulan] = $data->total;
            }
        }

        return view('pageadmin.dashboard.index', [
            'insiden' => $insiden,
            'jenisInsiden' => $jenisInsiden,
            'dataPerJenisPerBulan' => $dataPerJenisPerBulan,
            'dataInsiden' => [
                'biru' => array_values($dataPerBulan['biru']),
                'merah' => array_values($dataPerBulan['merah']),
                'total' => array_values($dataPerBulan['total'])
            ],
            'monthlyData' => $monthlyData,
            'selectedMonths' => $selectedMonths,
            'selectedYear' => $selectedYear,
            'insidenPerRuangan' => $insidenPerRuangan,
            'gradingData' => $gradingData
        ]);
    }

    public function resetFilter()
    {
        return redirect()->route('dashboard')->with('success', 'Filter berhasil direset');
    }

    public function getData(Request $request)
    {
        $year = $request->query('year', date('Y'));

        if (!is_numeric($year) || $year < 2020 || $year > (date('Y') + 1)) {
            return response()->json(['error' => 'Tahun tidak valid'], 400);
        }

        $insidenTotal = Insiden::select(
            DB::raw('MONTH(waktu_insiden) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('waktu_insiden', $year)
            ->groupBy('bulan')
            ->get();

        $dataPerBulan = array_fill(0, 12, 0);

        foreach ($insidenTotal as $item) {
            $dataPerBulan[$item->bulan - 1] = $item->total;
        }

        return response()->json([
            'total' => $dataPerBulan,
            'year' => $year
        ]);
    }

    public function exportPDF(Request $request)
    {
        $selectedYear = session('selectedYear', date('Y'));
        $selectedMonths = session('selectedMonths', []); 
        
        if (empty($selectedMonths)) {
            $selectedMonths = range(1, 12);
        }
        
        // Mengambil data insiden per bulan
        $dataInsiden = collect();
        
        foreach ($selectedMonths as $index => $bulan) {
            $jumlahInsiden = Insiden::whereMonth('waktu_insiden', $bulan)
                ->whereYear('waktu_insiden', $selectedYear)
                ->count();
                
            $dataInsiden->push([
                'no' => $index + 1,
                'periode' => 'Triwulan ' . ceil($bulan/3),
                'bulan' => \DateTime::createFromFormat('!m', $bulan)->format('F'),
                'jumlah_insiden' => $jumlahInsiden,
                'total' => $jumlahInsiden
            ]);
        }

        // Mengambil data grading per bulan
        $warnaGrading = DB::table('insiden')
            ->select(
                'grading',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('grading', 'bulan')
            ->orderBy('grading')
            ->get();

        // Menyusun data grading
        $gradingData = [];
        $gradings = ['Biru', 'Hijau', 'Kuning', 'Merah'];

        foreach ($gradings as $grading) {
            $gradingData[$grading] = [
                'grading' => $grading,
                'data' => array_fill(1, 12, 0)
            ];
        }

        foreach ($warnaGrading as $data) {
            if (isset($gradingData[$data->grading])) {
                $gradingData[$data->grading]['data'][$data->bulan] = $data->total;
            }
        }

        // Mengambil data jenis insiden
        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();
        $jumlahInsidenPerBulan = [];
        
        foreach ($jenisInsiden as $jenis) {
            $jumlahInsidenPerBulan[$jenis->jenis_insiden] = [];
            foreach ($selectedMonths as $bulan) {
                $jumlahInsidenPerBulan[$jenis->jenis_insiden][$bulan] = Insiden::where('jenis_insiden', $jenis->jenis_insiden)
                    ->whereMonth('waktu_insiden', $bulan)
                    ->whereYear('waktu_insiden', $selectedYear)
                    ->count();
            }
        }

        // Mengambil data tempat insiden
        $tempatInsiden = DB::table('insiden')
            ->select(
                DB::raw('ROW_NUMBER() OVER (ORDER BY tempat_insiden) as no'),
                'tempat_insiden',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('tempat_insiden', 'bulan')
            ->orderBy('tempat_insiden')
            ->get();

        // Menyusun data tempat insiden
        $tempatInsidenData = [];
        foreach ($tempatInsiden as $data) {
            if (!isset($tempatInsidenData[$data->tempat_insiden])) {
                $tempatInsidenData[$data->tempat_insiden] = [
                    'no' => $data->no,
                    'tempat' => $data->tempat_insiden,
                    'bulan' => [],
                    'total' => 0
                ];
            }
            $tempatInsidenData[$data->tempat_insiden]['bulan'][$data->bulan] = $data->total;
            $tempatInsidenData[$data->tempat_insiden]['total'] += $data->total;
        }

        $data = [
            'jenisInsiden' => $jenisInsiden,
            'jumlahInsidenPerBulan' => $jumlahInsidenPerBulan,
            'selectedMonths' => $selectedMonths,
            'selectedYear' => $selectedYear,
            'title' => 'Laporan Insiden - ' . $selectedYear,
            'dataInsiden' => $dataInsiden,
            'gradingData' => $gradingData,
            'tempatInsidenData' => $tempatInsidenData
        ];

        $pdf = PDF::loadView('pageadmin.dashboard.print', $data);
        
        $filename = 'laporan-insiden';
        if (!empty($selectedMonths)) {
            $bulanStr = implode('-', array_map(function($m) {
                return \DateTime::createFromFormat('!m', $m)->format('M');
            }, $selectedMonths));
            $filename .= '-' . $bulanStr;
        }
        $filename .= '-' . $selectedYear . '.pdf';

        return $pdf->download($filename);
    }

    public function exportWord(Request $request)
    {
        $selectedYear = session('selectedYear', date('Y'));
        $selectedMonths = session('selectedMonths', []); 
        
        if (empty($selectedMonths)) {
            $selectedMonths = range(1, 12);
        }
        
        // Menggunakan data yang sama seperti exportPDF
        $dataInsiden = collect();
        
        foreach ($selectedMonths as $index => $bulan) {
            $jumlahInsiden = Insiden::whereMonth('waktu_insiden', $bulan)
                ->whereYear('waktu_insiden', $selectedYear)
                ->count();
                
            $dataInsiden->push([
                'no' => $index + 1,
                'periode' => 'Triwulan ' . ceil($bulan/3),
                'bulan' => \DateTime::createFromFormat('!m', $bulan)->format('F'),
                'jumlah_insiden' => $jumlahInsiden,
                'total' => $jumlahInsiden
            ]);
        }

        // Mengambil data yang sama seperti sebelumnya
        $warnaGrading = DB::table('insiden')
            ->select(
                'grading',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('grading', 'bulan')
            ->orderBy('grading')
            ->get();

        // Menyusun data grading
        $gradingData = [];
        $gradings = ['Biru', 'Hijau', 'Kuning', 'Merah'];

        foreach ($gradings as $grading) {
            $gradingData[$grading] = [
                'grading' => $grading,
                'data' => array_fill(1, 12, 0)
            ];
        }

        foreach ($warnaGrading as $data) {
            if (isset($gradingData[$data->grading])) {
                $gradingData[$data->grading]['data'][$data->bulan] = $data->total;
            }
        }

        // Data lainnya sama seperti sebelumnya
        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();
        $jumlahInsidenPerBulan = [];
        
        foreach ($jenisInsiden as $jenis) {
            $jumlahInsidenPerBulan[$jenis->jenis_insiden] = [];
            foreach ($selectedMonths as $bulan) {
                $jumlahInsidenPerBulan[$jenis->jenis_insiden][$bulan] = Insiden::where('jenis_insiden', $jenis->jenis_insiden)
                    ->whereMonth('waktu_insiden', $bulan)
                    ->whereYear('waktu_insiden', $selectedYear)
                    ->count();
            }
        }

        $tempatInsiden = DB::table('insiden')
            ->select(
                DB::raw('ROW_NUMBER() OVER (ORDER BY tempat_insiden) as no'),
                'tempat_insiden',
                DB::raw('MONTH(waktu_insiden) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_insiden', $selectedYear)
            ->whereIn(DB::raw('MONTH(waktu_insiden)'), $selectedMonths)
            ->groupBy('tempat_insiden', 'bulan')
            ->orderBy('tempat_insiden')
            ->get();

        $tempatInsidenData = [];
        foreach ($tempatInsiden as $data) {
            if (!isset($tempatInsidenData[$data->tempat_insiden])) {
                $tempatInsidenData[$data->tempat_insiden] = [
                    'no' => $data->no,
                    'tempat' => $data->tempat_insiden,
                    'bulan' => [],
                    'total' => 0
                ];
            }
            $tempatInsidenData[$data->tempat_insiden]['bulan'][$data->bulan] = $data->total;
            $tempatInsidenData[$data->tempat_insiden]['total'] += $data->total;
        }

        $data = [
            'jenisInsiden' => $jenisInsiden,
            'jumlahInsidenPerBulan' => $jumlahInsidenPerBulan,
            'selectedMonths' => $selectedMonths,
            'selectedYear' => $selectedYear,
            'title' => 'Laporan Insiden - ' . $selectedYear,
            'dataInsiden' => $dataInsiden,
            'gradingData' => $gradingData,
            'tempatInsidenData' => $tempatInsidenData
        ];

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="laporan-insiden.docx"'
        ];

        return response()->view('pageadmin.dashboard.word', $data)
            ->withHeaders($headers);
    }
}
