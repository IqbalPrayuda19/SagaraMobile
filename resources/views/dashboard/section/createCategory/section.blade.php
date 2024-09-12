<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/settings" class="position-absolute top-0 start-0 mt-3 ms-3">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body d-flex flex-column align-items-center px-4 py-4">
            <form style="width: 100%" class="animate__animated animate__fadeIn">
                @csrf
                <h4 class="card-title mt-2 text-center">Penambahan Category Baru</h4>
                <div class="row g-3 mt-4">
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Jenis Category</label>
                            <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset">
                        </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">simpan</button>
                    <a href="/assets" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

