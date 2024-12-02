<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insiden;
use Illuminate\Support\Facades\DB;

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
        
        foreach($insidenTotal as $item) {
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
            'insidenPerRuangan' => $insidenPerRuangan
        ]);
    }

    public function filter(Request $request)
    {
        $selectedMonths = $request->months ?? [];
        $selectedYear = $request->year ?? date('Y');
        
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

        foreach($insidenTotal as $item) {
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
            'insidenPerRuangan' => $insidenPerRuangan
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
        
        foreach($insidenTotal as $item) {
            $dataPerBulan[$item->bulan - 1] = $item->total;
        }

        return response()->json([
            'total' => $dataPerBulan,
            'year' => $year
        ]);
    }
}