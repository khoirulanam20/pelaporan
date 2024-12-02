<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insiden;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Reset session filter bulan
        session()->forget('selectedMonths');
        
        $selectedMonths = range(1, 12); // Set default ke semua bulan
        
        // Ambil semua insiden dan jenis insiden yang unik
        $insiden = Insiden::all();
        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();
        
        // Inisialisasi array untuk menyimpan data per jenis insiden per bulan
        $dataPerJenisPerBulan = [];
        
        foreach ($jenisInsiden as $jenis) {
            $dataPerJenisPerBulan[$jenis->jenis_insiden] = array_fill(1, 12, 0);
            
            // Hitung jumlah insiden per bulan untuk setiap jenis
            $insidenPerBulan = Insiden::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('jenis_insiden', $jenis->jenis_insiden)
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->get();
            
            // Isi data ke array
            foreach ($insidenPerBulan as $data) {
                $dataPerJenisPerBulan[$jenis->jenis_insiden][$data->bulan] = $data->total;
            }
        }
        
        $insidenTotal = Insiden::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
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
        
        // Hitung insiden bulan ini dan persentase
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $insidenBulanIni = Insiden::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            
        $lastMonth = date('m', strtotime('-1 month'));
        $lastMonthYear = $lastMonth == 12 ? $currentYear - 1 : $currentYear;
        
        $insidenBulanLalu = Insiden::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->count();
        
        $percentage = $insidenBulanLalu > 0 
            ? round((($insidenBulanIni - $insidenBulanLalu) / $insidenBulanLalu) * 100, 2)
            : 0;
            
        $monthlyData = [
            'month' => $insidenBulanIni,
            'percentage' => $percentage . '%'
        ];

        // Hitung jumlah insiden per ruangan
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
            'insidenPerRuangan' => $insidenPerRuangan
        ]);
    }

    public function filter(Request $request)
    {
        $selectedMonths = $request->months ?? [];
        
        // Tambahkan query untuk mengambil insiden
        $insiden = Insiden::whereIn(DB::raw('MONTH(created_at)'), $selectedMonths)
            ->whereYear('created_at', date('Y'))
            ->get();
            
        // Ambil semua jenis insiden yang unik
        $jenisInsiden = Insiden::select('jenis_insiden')->distinct()->get();
        
        // Inisialisasi array untuk menyimpan data per jenis insiden per bulan
        $dataPerJenisPerBulan = [];
        
        foreach ($jenisInsiden as $jenis) {
            $dataPerJenisPerBulan[$jenis->jenis_insiden] = array_fill(1, 12, 0);
            
            // Hitung jumlah insiden per bulan untuk setiap jenis
            $insidenPerBulan = Insiden::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('jenis_insiden', $jenis->jenis_insiden)
            ->whereYear('created_at', date('Y'))
            ->whereIn(DB::raw('MONTH(created_at)'), $selectedMonths)
            ->groupBy('bulan')
            ->get();
            
            foreach ($insidenPerBulan as $data) {
                $dataPerJenisPerBulan[$jenis->jenis_insiden][$data->bulan] = $data->total;
            }
        }

        // Hitung total insiden per bulan yang difilter
        $insidenTotal = Insiden::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->whereIn(DB::raw('MONTH(created_at)'), $selectedMonths)
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

        // Hitung data untuk bulan ini dan persentase
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $insidenBulanIni = Insiden::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            
        $lastMonth = date('m', strtotime('-1 month'));
        $lastMonthYear = $lastMonth == 12 ? $currentYear - 1 : $currentYear;
        
        $insidenBulanLalu = Insiden::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->count();
        
        $percentage = $insidenBulanLalu > 0 
            ? round((($insidenBulanIni - $insidenBulanLalu) / $insidenBulanLalu) * 100, 2)
            : 0;
            
        $monthlyData = [
            'month' => $insidenBulanIni,
            'percentage' => $percentage . '%'
        ];

        // Hitung jumlah insiden per ruangan
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
            'insidenPerRuangan' => $insidenPerRuangan
        ]);
    }

    public function resetFilter()
    {
        return redirect()->route('dashboard')->with('success', 'Filter berhasil direset');
    }
}