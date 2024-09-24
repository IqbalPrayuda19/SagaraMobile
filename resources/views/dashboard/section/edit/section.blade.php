<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/assets" class="position-absolute top-0 start-0 mt-3 ms-3">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body px-4 py-2">
            <form action="{{route('postUpdate', [$assets->uuid])}}" method="POST">
                @csrf
                <h4 class="card-title mt-5">Penyimpanan Aset Baru</h4>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Nama aset</label>
                            <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset" value="{{$assets->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label fw-semibold">Lokasi</label>
                            <select name="location_id" class="form-select" id="akun-asset">
                                <option value="" disabled> Pilih </option>
                                @foreach ($locations as $location )
                                    <option value="{{$location->id}}" {{$assets->location_id == $location->id ? 'selected':''}}>{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nomor-asset" class="form-label fw-semibold">Akun Aset Tetap</label>
                            <select name="account_fixed_asset" class="form-select" id="akun-asset-tetap">
                                <option value="" disabled> Pilih </option>
                                <option value="Aset Tetap - Tanah" {{$assets->account_fixed_asset == 'Aset Tetap - Tanah' ? 'selected':''}}>Aset Tetap - Tanah</option>
                                <option value="Aset Tetap - Bangunan" {{$assets->account_fixed_asset == 'Aset Tetap - Bangunan' ? 'selected':''}}>Aset Tetap - Bangunan</option>
                                <option value="Aset Tetap - Building Improvements" {{$assets->account_fixed_asset == 'Aset Tetap - Building Improvements' ? 'selected':''}}>Aset Tetap - Building Improvements</option>
                                <option value="Aset Tetap - Kendaraan" {{$assets->account_fixed_asset == 'Aset Tetap - Kendaraan' ? 'selected':''}}>Aset Tetap - Kendaraan</option>
                                <option value="Aset Tetap - Mesin & Peralatan" {{$assets->account_fixed_asset == 'Aset Tetap - Mesin & Peralatan' ? 'selected':''}}>Aset Tetap - Mesin & Peralatan</option>
                                <option value="Aset Tetap - Peralatan Kantor" {{$assets->account_fixed_asset == 'Aset Tetap - Peralatan Kantor' ? 'selected':''}}>Aset Tetap - Peralatan Kantor</option>
                                <option value="Aset Tetap - Aset Sewa Guna Usaha" {{$assets->account_fixed_asset == 'Aset Tetap - Aset Sewa Guna Usaha' ? 'selected':''}}>Aset Tetap - Aset Sewa Guna Usaha</option>
                                <option value="Aset Tak Berwujud" {{$assets->account_fixed_asset == 'Aset Tak Berwujud' ? 'selected':''}}>Aset Tak Berwujud</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label fw-semibold">Deskripsi</label>
                            <input value="{{$assets->description}}" name="description" type="text" class="form-control" id="Deskripsi" placeholder="Deskripsi">
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="akun-asset" class="form-label fw-semibold">Kategori</label>
                            <select name="categories_id" class="form-select" id="akun-asset">
                                <option value="" disabled> Pilih </option>
                               @foreach ($categories as $category )
                                    <option value="{{$category->id}} {{$assets->category_id == $category->id ? 'selected':''}}">{{$category->name}}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="mb-3">
                            <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Akuisisi</label>
                            <input value="{{$assets->accuisition_date}}" name="accuisition_date" type="date" class="form-control" id="tanggal-akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="biaya-akuisisi" class="form-label fw-semibold">Biaya Akuisisi</label>
                            <div class="input-group">
                                <input value="{{$assets->accuisition_cost}}" name="accuisition_cost" type="text" class="form-control"
                                    aria-label="Dollar amount (with dot and two decimal places)"
                                    id="biaya-akuisisi" placeholder="Biaya Akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="card-title mt-4 mb-4">Penyusutan</h4>
                <div class="checkbox mb-4">
                    <input name="non_depreciation" {{$assets->non_depreciation == 1 ? 'checked':''}} type="checkbox" class="form-check-input me-2" id="checkbox2">
                        <label for="checkbox2">Assets non Depresiasi</label>
                    </div>
                <div class="mb-3">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Metode</label>
                            <select name="method" class="form-select" id="Metode">
                                <option value="" disabled> Pilih </option>
                                @foreach (\App\Enums\Method::cases() as $method)
                                    <option value="{{ $method->name }}" {{$assets->method}}>{{ $method->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Depresiasi Akun Penyusutan</label>
                            <select name="depreciation_account" class="form-select" id="Akun penyusutan">
                                <option value="" disabled> Pilih </option>
                                <option value="Penyusutan - Bangunan" {{$assets->depreciation_account == 'Penyusutan - Bangunan' ? 'selected':''}}>Penyusutan - Bangunan</option>
                                <option value="Penyusutan - Building Improvements" {{$assets->depreciation_account == 'Penyusutan - Building Improvements' ? 'selected':''}}>Penyusutan - Building Improvementsi</option>
                                <option value="Penyusutan - Kendaraan" {{$assets->depreciation_account == 'Penyusutan - Kendaraan' ? 'selected':''}}>Penyusutan - Kendaraan</option>
                                <option value="Penyusutan - Mesin & Peralatan" {{$assets->depreciation_account == 'Penyusutan - Mesin & Peralatan' ? 'selected':''}}>Penyusutan - Mesin & Peralatan</option>
                                <option value="Penyusutan - Peralatan Kantor" {{$assets->depreciation_account == 'Penyusutan - Peralatan Kantor' ? 'selected':''}}>Penyusutan - Peralatan Kantor</option>
                                <option value="Penyusutan - Aset Sewa Guna Usaha" {{$assets->depreciation_account == 'Penyusutan - Aset Sewa Guna Usaha' ? 'selected':''}}>Penyusutan - Aset Sewa Guna Usaha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Periode Penggunaan</label>
                        <div class="mb-3">
                            <input value="{{$assets->usage_period}}" name="usage_period" type="text" class="form-control" id="Periode Penggunaan" placeholder="Periode Penggunaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Akumulasi  Depresiasi Akun Penyusutan</label>
                            <select name="accumulation_depreciation_account" class="form-select" id="Akumulasi Akun Penyusutan">
                                <option value="" disabled> Pilih </option>
                                <option value="Akumulasi Penyusutan - Bangunan" {{$assets->accumulation_depreciation_account == 'Akumulasi Penyusutan - Bangunan' ? 'selected':''}}>Akumulasi Penyusutan - Bangunan</option>
                                <option value="Akumulasi Penyusutan - Building Improvements" {{$assets->accumulation_depreciation_account == 'Akumulasi Penyusutan - Building Improvements' ? 'selected':''}}>Akumulasi Penyusutan - Building Improvements</option>
                                <option value="Akumulasi penyusutan - Kendaraan" {{$assets->accumulation_depreciation_account == 'Akumulasi penyusutan - Kendaraan' ? 'selected':''}}>Akumulasi penyusutan - Kendaraan</option>
                                <option value="Akumulasi Penyusutan - Mesin & Peralatan" {{$assets->accumulation_depreciation_account == 'Akumulasi Penyusutan - Mesin & Peralatan' ? 'selected':''}}>Akumulasi Penyusutan - Mesin & Peralatan</option>
                                <option value="Akumulasi Penyusutan - Peralatan Kantor" {{$assets->accumulation_depreciation_account == 'Akumulasi Penyusutan - Peralatan Kantor' ? 'selected':''}}>Akumulasi Penyusutan - Peralatan Kantor</option>
                                <option value="Akumulasi Penyusutan - Aset Sewa Guna Usaha" {{$assets->accumulation_depreciation_account == 'Akumulasi Penyusutan - Aset Sewa Guna Usaha' ? 'selected':''}}>Akumulasi Penyusutan - Aset Sewa Guna Usaha</option>
                                <option value="Akumulasi Amortisasi" {{$assets->accumulation_depreciation_account == 'Akumulasi Amortisasi' ? 'selected':''}}>Akumulasi Amortisasi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Nilai Penyusutan Pertahun</label>
                        <div class="mb-3">
                            <input value="{{$assets->usage_value_per_year}}" name="usage_value_per_year" type="text" class="form-control" id="Nilai Penyusutan" placeholder="Nilai Penyusutan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Total Penyusutan</label>
                            <input value="{{$assets->accumulation_depreciation_value}}" name="accumulation_depreciation_value" type="text" class="form-control" id="Penyusutan" placeholder="Total Penyusutan">
                        </div>
                    </div>
                </div>
                <div class="mb-4 mt-2">
                    <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Penyusutan</label>
                    <input value="{{$assets->depreciation_date}}" name="depreciation_date" type="date" class="form-control" id="Tanggal Penyusutan">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary" onclick="return confirmSave(event)">simpan</button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        function confirmSave(event) {
                            event.preventDefault();
                            var form = event.target.form;
                            Swal.fire({
                                title: 'yakin?',
                                text: "Jika Mengubah Data Aset, Data Aset Akan Berubah",
                                icon: 'Peringatan',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Simpan!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                    Swal.fire(
                                        'Berhasil!',
                                        'Data Asset Berhasil Diubah',
                                        'success'
                                    )
                                }
                            });
                            return false;
                        }
                    </script>
                    <a href="/assets" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

