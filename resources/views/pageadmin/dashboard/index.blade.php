@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-info">Total Insiden Biru</p>
                                    <h4 class="my-1 text-info">{{ $insiden->where('grading', 'Biru')->count() }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                        class='bx bx-error-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-danger">Total Insiden Merah</p>
                                    <h4 class="my-1 text-danger">{{ $insiden->where('grading', 'Merah')->count() }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                        class='bx bx-error-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-success">Total Insiden Hijau</p>
                                    <h4 class="my-1 text-success">{{ $insiden->where('grading', 'Hijau')->count() }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                        class='bx bx-error-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-warning">Total Insiden Kuning</p>
                                    <h4 class="my-1 text-warning">{{ $insiden->where('grading', 'Kuning')->count() }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                        class='bx bx-error-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Jumlah Insiden</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#filterModal">
                                                Filter
                                            </a>
                                            <form action="{{ route('dashboard.reset-filter') }}" method="POST" id="resetFilterForm">
                                                @csrf
                                                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('resetFilterForm').submit();">
                                                    Reset Filter
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                                <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                        style="color: #14abef"></i>Insiden</span>
                            </div>
                            <div class="chart-container-1">
                                <canvas id="insidenChart"></canvas>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ $insiden->count() }}</h5>
                                    <small class="mb-0">Overall Insiden {{ $selectedYear }}</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ $monthlyData['month'] ?? 0 }}</h5>
                                    <small class="mb-0">Insiden Bulan {{ now()->format('F Y') }}</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ $monthlyData['percentage'] }}</h5>
                                    <small class="mb-0">Kenaikan Jumlah Insiden dari {{ now()->subMonth()->format('F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Insiden Berdasarkan Ruangan</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>  
                            <div class="chart-container-2 mt-4">
                                <canvas id="chart2"></canvas>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($insidenPerRuangan as $data)
                                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    {{ $data->ruanganRelasi->nama_ruangan }} <span class="badge bg-primary rounded-pill">{{ $data->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Insiden Terbaru</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#filterModal">
                                        Filter
                                    </a>
                                    <form action="{{ route('dashboard.reset-filter') }}" method="POST" id="resetFilterForm">
                                        @csrf
                                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('resetFilterForm').submit();">
                                            Reset Filter
                                        </a>
                                    </form>
                                    <a href="{{ route('dashboard.export') }}" class="dropdown-item">
                                        <i class="bx bx-export"></i> Export PDF
                                    </a>
                                    <a href="{{ route('dashboard.export-word') }}" class="dropdown-item">
                                        <i class="bx bx-export"></i> Export Word
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Insiden</th>
                                    @if (!empty($selectedMonths))
                                        @foreach ($selectedMonths as $bulan)
                                            <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $selectedYear }}</th>
                                        @endforeach
                                    @else
                                        <th>Januari {{ $selectedYear }}</th>
                                        <th>Februari {{ $selectedYear }}</th>
                                        <th>Maret {{ $selectedYear }}</th>
                                        <th>April {{ $selectedYear }}</th>
                                        <th>Mei {{ $selectedYear }}</th>
                                        <th>Juni {{ $selectedYear }}</th>
                                        <th>Juli {{ $selectedYear }}</th>
                                        <th>Agustus {{ $selectedYear }}</th>
                                        <th>September {{ $selectedYear }}</th>
                                        <th>Oktober {{ $selectedYear }}</th>
                                        <th>November {{ $selectedYear }}</th>
                                        <th>Desember {{ $selectedYear }}</th>
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
                                                <td>{{ $dataPerJenisPerBulan[$item->jenis_insiden][$bulan] }}</td>
                                            @endforeach
                                        @else
                                            @for ($bulan = 1; $bulan <= 12; $bulan++)
                                                <td>{{ $dataPerJenisPerBulan[$item->jenis_insiden][$bulan] }}</td>
                                            @endfor
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Filter -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filter Berdasarkan Bulan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('dashboard.filter') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Tahun</label>
                                    <select name="year" class="form-control mb-3">
                                        @php
                                            $currentYear = date('Y');
                                            $startYear =  $currentYear - 2;
                                            $endYear = $currentYear + 1;
                                        @endphp
                                        @for($year = $startYear; $year <= $endYear; $year++)
                                            <option value="{{ $year }}" {{ ($selectedYear ?? $currentYear) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                    <label class="form-label">Pilih Bulan</label>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="1" id="bulan1" 
                                                    {{ in_array(1, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan1">Januari</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="2" id="bulan2"
                                                    {{ in_array(2, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan2">Februari</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="3" id="bulan3"
                                                    {{ in_array(3, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan3">Maret</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="4" id="bulan4"
                                                    {{ in_array(4, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan4">April</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="5" id="bulan5"
                                                    {{ in_array(5, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan5">Mei</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="6" id="bulan6"
                                                    {{ in_array(6, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan6">Juni</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="7" id="bulan7"
                                                    {{ in_array(7, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan7">Juli</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="8" id="bulan8"
                                                    {{ in_array(8, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan8">Agustus</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="9" id="bulan9"
                                                    {{ in_array(9, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan9">September</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="10" id="bulan10"
                                                    {{ in_array(10, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan10">Oktober</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="11" id="bulan11"
                                                    {{ in_array(11, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan11">November</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="months[]" value="12" id="bulan12"
                                                    {{ in_array(12, $selectedMonths ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bulan12">Desember</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @section('script')
            <script src="{{ asset('admin/assets/js/index.js') }}"></script>
            <script src="{{ asset('admin/assets/js/chart2.js') }}"></script>
            <script>
                var insidenPerRuangan = @json($insidenPerRuangan);
                var dataInsiden = @json($dataInsiden);
                var selectedMonths = {!! json_encode($selectedMonths ?? []) !!};
                var selectedYear = {{ $selectedYear ?? 'new Date().getFullYear()' }};
            </script>
        @endsection
