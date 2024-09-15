<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <a href="/settings" class="position-absolute top-0 start-0 mt-3 ms-3">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body d-flex flex-column align-items-center px-4 py-4">
            <form action="{{route('createLocations')}}" method="POST" style="width: 100%">
                @csrf
                <h4 class="card-title mt-2 text-center">Penambahan Lokasi Baru</h4>

                <div class="mb-3">
                    <label for="detail-asset" class="form-label fw-semibold">Nama Toko</label>
                    <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset">
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">simpan</button>
                    <a href="/setting" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</section>
