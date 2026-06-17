<div class="col-12 px-3 px-md-4 px-lg-5 py-4 py-md-5" style="font-family: 'Poppins', sans-serif;">
    <div class="card rounded-4 px-4 px-md-4 px-lg-5 py-4 shadow border-0 position-relative">
        <a href="/settings" class="position-absolute top-0 start-0 mt-4 ms-2 ms-md-4 text-primary">
            <i data-feather="arrow-left" style="width: 28px; height: 28px;"></i>
        </a>
        <div class="card-body d-flex flex-column align-items-center px-0 mt-5">
            <form action="{{route('createLocations')}}" method="POST" style="width: 100%">
                @csrf
                <h4 class="card-title mt-2 text-center">Penambahan Lokasi Baru</h4>

                <div class="mb-3">
                    <label for="detail-asset" class="form-label fw-semibold">Nama Toko<span class="text-danger mx-3">*</span></label>
                    <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset" required>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/settings" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
