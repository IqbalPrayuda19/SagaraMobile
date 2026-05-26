@extends('dashboard.layouts.main')

@section('container')
<div class="col-12 px-3 px-md-4 px-lg-5 py-4 py-md-5" style="font-family: 'Poppins', sans-serif;">
    <div class="card px-4 px-md-4 px-lg-5 shadow rounded-4 border-0 position-relative">
        <a href="/asset" class="position-absolute top-0 start-0 mt-4 ms-2 ms-md-4 text-primary">
            <i data-feather="arrow-left" style="width: 28px; height: 28px;"></i>
        </a>
        <div class="card-header bg-white border-bottom pb-3 pt-5 px-4 mt-2">
            <h3 class="card-title mb-0 fw-bold text-start">Detail Statistik Aset</h3>
        </div>
        
        <div class="card-body px-0 pt-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="width: 50%;">Keterangan</th>
                            <th class="text-center" style="width: 50%;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center fw-semibold py-3">
                                <div class="d-inline-flex align-items-center">
                                    <i data-feather="dollar-sign" class="text-success me-2"></i> Total Nilai Aset
                                </div>
                            </td>
                            <td class="text-center fw-bold py-3 fs-5">Rp {{ number_format($totalAssetValue, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold py-4 align-middle">
                                <div class="d-inline-flex align-items-center">
                                    <i data-feather="layers" class="text-info me-2"></i> Daftar Kategori ({{ $categories->count() }})
                                </div>
                            </td>
                            <td class="text-center py-4">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    @forelse($categories as $category)
                                        <span class="badge rounded-pill" style="background-color: rgba(13, 202, 240, 0.1); color: #0dcaf0; border: 1px solid #0dcaf0; font-size: 0.85rem; padding: 0.4rem 0.8rem;">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted fw-normal">Belum ada kategori terdaftar</span>
                                    @endforelse
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold py-4 align-middle">
                                <div class="d-inline-flex align-items-center">
                                    <i data-feather="map-pin" class="text-warning me-2"></i> Daftar Lokasi ({{ $locations->count() }})
                                </div>
                            </td>
                            <td class="text-center py-4">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    @forelse($locations as $location)
                                        <span class="badge rounded-pill" style="background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; border: 1px solid #fd7e14; font-size: 0.85rem; padding: 0.4rem 0.8rem;">
                                            {{ $location->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted fw-normal">Belum ada lokasi terdaftar</span>
                                    @endforelse
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
