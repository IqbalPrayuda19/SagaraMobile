<div class="col-12 px-3 px-md-4 px-lg-5 py-4 py-md-5" style="font-family: 'Poppins', sans-serif;">
    <div class="bg-white p-2 rounded-4 shadow mb-4">
        <h4 class="text-dark fw-medium mb-0 p-2 ps-3">Welcome back {{ auth()->user()->name }}</h4>
    </div>

    {{-- SUMMARY CARDS (STATISTIK CEPAT) --}}
    <div class="row g-4 mb-4">
        {{-- Total Assets --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div onclick="window.location.href='/asset'" class="bg-white rounded-4 shadow p-3 h-100 border-start border-4 border-primary" style="transition: transform 0.2s; cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: rgba(67, 94, 190, 0.1);">
                        <i data-feather="box" style="color: #435ebe; width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Total Aset</h6>
                        <h5 class="mb-0 fw-bold text-dark">{{ $totalAssets }}</h5>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Total Asset Value --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div onclick="window.location.href='/asset/detail'" class="bg-white rounded-4 shadow p-3 h-100 border-start border-4 border-success cursor-pointer" style="transition: transform 0.2s; cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: rgba(25, 135, 84, 0.1);">
                        <i data-feather="dollar-sign" style="color: #198754; width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Total Nilai Aset</h6>
                        <h5 class="mb-0 fw-bold text-dark text-truncate" style="max-width: 150px;" title="Rp {{ number_format($totalAssetValue, 0, ',', '.') }}">
                            Rp {{ number_format($totalAssetValue, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Categories --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div onclick="window.location.href='/asset/detail'" class="bg-white rounded-4 shadow p-3 h-100 border-start border-4 border-info cursor-pointer" style="transition: transform 0.2s; cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: rgba(13, 202, 240, 0.1);">
                        <i data-feather="layers" style="color: #0dcaf0; width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Total Kategori</h6>
                        <h5 class="mb-0 fw-bold text-dark">{{ $totalCategories }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Locations --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div onclick="window.location.href='/asset/detail'" class="bg-white rounded-4 shadow p-3 h-100 border-start border-4 border-warning cursor-pointer" style="transition: transform 0.2s; cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: rgba(253, 126, 20, 0.1);">
                        <i data-feather="map-pin" style="color: #fd7e14; width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Total Lokasi</h6>
                        <h5 class="mb-0 fw-bold text-dark">{{ $totalLocations }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DESKTOP TABLE (TETAP) --}}
    <div class="d-none d-lg-flex flex-row gap-4 mt-4 w-100">
        {{-- Table Assets --}}
        <a href="/asset" class="table-responsive bg-white p-1 rounded-4 shadow text-decoration-none d-block" style="flex: 1; max-height: 200px;">
            <div class="table-responsive bg-white p-1 rounded shadow" style="width: 100%; height: 100%;">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Nama Assets</th>
                            <th class="text-start">Biaya Akuisisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td class="text-start text-dark">{{ $asset->name }}</td>
                                <td class="text-start text-dark">Rp {{ number_format($asset->accuisition_cost, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-start text-muted">Tidak ada assets</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </a>

        {{-- Table History --}}
        <a href="/history" class="table-responsive bg-white p-1 rounded-4 shadow text-decoration-none d-block" style="flex: 1; max-height: 200px;">
            <div class="table-responsive bg-white p-1 rounded shadow" style="width: 100%; height: 100%;">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">History</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history->take(3) as $transaction)
                            <tr>
                                <td class="text-start text-dark">{{ $transaction }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-start text-muted">Tidak ada history</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </a>

        {{-- Table Settings --}}
        <div onclick="window.location.href='/settings'" class="bg-white p-1 rounded-4 shadow d-flex flex-column" style="flex: 1; max-height: 200px; cursor: pointer;">
            <div class="table-responsive bg-white p-1 rounded shadow" style="width: 100%; height: 100%;">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3">
                                <h6 class="mb-3 d-flex align-items-center text-dark fw-medium">
                                    <a href="/createLocations" class="pe-2 text-primary" onclick="event.stopPropagation();">
                                        <i data-feather="plus-square" style="width: 20px; height: 20px;"></i>
                                    </a>
                                    Penambahan Lokasi Baru 
                                </h6>
                                <h6 class="mb-2 d-flex align-items-center text-dark fw-medium">
                                    <a href="/createCategories" class="pe-2 text-primary" onclick="event.stopPropagation();">
                                        <i data-feather="plus-square" style="width: 20px; height: 20px;"></i>
                                    </a>
                                    Penambahan Kategori Baru 
                                </h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MOBILE VERSION: KARTU GRID --}}
    <div class="d-block d-lg-none mt-4">
        {{-- Cards Assets --}}
        <div class="mb-3">
            <a href="/asset" class="text-decoration-none text-dark">
                <div class="card shadow rounded-4 p-3">
                    <h5 class="fw-bold mb-3">Assets</h5>
                    @forelse($assets as $asset)
                        <div class="mb-2">
                            <p class="mb-1"><strong>Nama:</strong> {{ $asset->name }}</p>
                            <p class="mb-0"><strong>Biaya:</strong> Rp {{ number_format($asset->accuisition_cost, 0, ',', '.') }}</p>
                        </div>
                        <hr class="my-2">
                    @empty
                        <p class="text-muted">Tidak ada assets</p>
                    @endforelse
                </div>
            </a>
        </div>

        {{-- Cards History --}}
        <div>
            <a href="/history" class="text-decoration-none text-dark">
                <div class="card shadow rounded-4 p-3">
                    <h5 class="fw-bold mb-3">History</h5>
                    @forelse($history->take(3) as $transaction)
                        <p class="mb-2">{{ $transaction }}</p>
                        <hr class="my-2">
                    @empty
                        <p class="text-muted">Tidak ada history</p>
                    @endforelse
                </div>
            </a>
        </div>

        {{-- Cards Settings --}}
        <div class="mt-3" onclick="window.location.href='/settings'" style="cursor: pointer;">
            <div class="card shadow rounded-4 p-3 bg-white">
                <h5 class="fw-bold mb-4">Settings</h5>
                
                <h6 class="mb-3 d-flex align-items-center text-dark">
                    <a href="/createLocations" class="me-2 text-primary" onclick="event.stopPropagation();">
                        <i data-feather="plus-square" style="width: 20px; height: 20px;"></i>
                    </a>
                    Penambahan Lokasi Baru 
                </h6>
                <hr class="my-2">
                <h6 class="mb-2 d-flex align-items-center text-dark mt-2">
                    <a href="/createCategories" class="me-2 text-primary" onclick="event.stopPropagation();">
                        <i data-feather="plus-square" style="width: 20px; height: 20px;"></i>
                    </a>
                    Penambahan Kategori Baru 
                </h6>
            </div>
        </div>
    </div>
</div>
