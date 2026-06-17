<div class="col-12 px-3 px-md-4 px-lg-5 py-4 py-md-5" style="font-family: 'Poppins', sans-serif;">
    <div class="card rounded-4 px-4 px-md-4 px-lg-5 py-4 shadow border-0 position-relative">
        <a href="/settings" class="position-absolute top-0 start-0 mt-4 ms-2 ms-md-4 text-primary">
            <i data-feather="arrow-left" style="width: 28px; height: 28px;"></i>
        </a>
        <div class="card-body d-flex flex-column align-items-center px-0 mt-5">
            <form action="{{route('createCategories')}}" method="POST" style="width: 100%">
                @csrf
                <h4 class="card-title mt-2 text-center">Penambahan Kategori Baru</h4>

                <div class="mb-3">
                    <label for="detail-asset" class="form-label fw-semibold">Jenis Kategori<span class="text-danger mx-3">*</span></label>
                    <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Kategori" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_depreciated" checked>
                    <label class="form-check-label fw-semibold" for="is_depreciated">
                        Kategori ini menyusut?
                    </label>
                </div>
                
                <div class="mb-3" id="percentage_container">
                    <label for="percentage" class="form-label fw-semibold">Persentase (%)<span class="text-danger mx-3">*</span></label>
                    <input name="percentage" type="text" class="form-control" id="percentage" placeholder="Contoh: 12.5 atau 12,5" required value="0">
                </div>

                <script>
                    document.getElementById('is_depreciated').addEventListener('change', function() {
                        const container = document.getElementById('percentage_container');
                        const input = document.getElementById('percentage');
                        if (this.checked) {
                            container.style.display = 'block';
                            input.required = true;
                        } else {
                            container.style.display = 'none';
                            input.required = false;
                            input.value = 0;
                        }
                    });

                    // Otomatis ubah koma menjadi titik dan pastikan hanya angka/titik yang bisa diketik
                    document.getElementById('percentage').addEventListener('input', function() {
                        let value = this.value;
                        // Ubah koma ke titik
                        value = value.replace(',', '.');
                        // Hapus karakter selain angka dan titik
                        value = value.replace(/[^0-9.]/g, '');
                        // Pastikan hanya ada satu titik
                        const parts = value.split('.');
                        if (parts.length > 2) {
                            value = parts[0] + '.' + parts.slice(1).join('');
                        }
                        this.value = value;
                    });
                </script>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/settings" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

