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
                <div class="col-12">
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
                                                Filter Bulan
                                            </a>
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
                                    <small class="mb-0">Overall Insiden</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ $monthlyData['month'] }}</h5>
                                    <small class="mb-0">Insiden Bulan Ini</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ $monthlyData['percentage'] }}</h5>
                                    <small class="mb-0">Kenaikan Jumlah Insiden</small>
                                </div>
                            </div>
                        </div>
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
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#filterModal">
                                        Filter Bulan
                                    </a>
                                    <a href="{{ route('insiden.export') }}" class="dropdown-item">
                                        Export Data
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
                                            <th>{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</th>
                                        @endforeach
                                    @else
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('dashboard.filter') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Bulan (Maksimal 3)</label>
                                    <select name="months[]" class="form-select" multiple>
                                        <option value="1" {{ in_array(1, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Januari</option>
                                        <option value="2" {{ in_array(2, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Februari</option>
                                        <option value="3" {{ in_array(3, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Maret</option>
                                        <option value="4" {{ in_array(4, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            April</option>
                                        <option value="5" {{ in_array(5, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Mei</option>
                                        <option value="6" {{ in_array(6, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Juni</option>
                                        <option value="7" {{ in_array(7, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Juli</option>
                                        <option value="8" {{ in_array(8, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            Agustus</option>
                                        <option value="9" {{ in_array(9, $selectedMonths ?? []) ? 'selected' : '' }}>
                                            September</option>
                                        <option value="10"
                                            {{ in_array(10, $selectedMonths ?? []) ? 'selected' : '' }}>Oktober</option>
                                        <option value="11"
                                            {{ in_array(11, $selectedMonths ?? []) ? 'selected' : '' }}>November</option>
                                        <option value="12"
                                            {{ in_array(12, $selectedMonths ?? []) ? 'selected' : '' }}>Desember</option>
                                    </select>
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
            <script>
                var dataInsiden = @json($dataInsiden);
                var selectedMonths = @json($selectedMonths ?? []);
            </script>
            <script>
                document.querySelector('select[name="months[]"]').addEventListener('change', function() {
                    if (this.selectedOptions.length > 3) {
                        alert('Anda hanya dapat memilih maksimal 3 bulan');
                        Array.from(this.selectedOptions)
                            .slice(3)
                            .forEach(option => option.selected = false);
                    }
                });
            </script>
        @endsection
