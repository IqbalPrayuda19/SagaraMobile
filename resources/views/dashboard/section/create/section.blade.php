<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/assets" class="position-absolute top-0 start-0 mt-3 ms-3">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body px-4 py-2">
            <form action="{{route('postStore')}}" method="POST">
                @csrf
                <h4 class="card-title mt-5">Penyimpanan Aset Baru</h4>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Nama aset</label>
                            <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset">
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label fw-semibold">Lokasi</label>
                            <select name="location_id" class="form-select" id="akun-asset">
                                <option value="" selected disabled> Pilih </option>
                                @foreach ($locations as $location )
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nomor-asset" class="form-label fw-semibold">Akun Aset Tetap</label>
                            <select name="account_fixed_asset" class="form-select" id="akun-asset-tetap">
                                <option value="" selected disabled> Pilih </option>
                                <option value="Aset Tetap - Tanah">Aset Tetap - Tanah</option>
                                <option value="Aset Tetap - Bangunan">Aset Tetap - Bangunan</option>
                                <option value="Aset Tetap - Building Improvements">Aset Tetap - Building Improvements</option>
                                <option value="Aset Tetap - Kendaraan">Aset Tetap - Kendaraan</option>
                                <option value="Aset Tetap - Mesin & Peralatan">Aset Tetap - Mesin & Peralatan</option>
                                <option value="Aset Tetap - Peralatan Kantor">Aset Tetap - Peralatan Kantor</option>
                                <option value="Aset Tetap - Aset Sewa Guna Usaha">Aset Tetap - Aset Sewa Guna Usaha</option>
                                <option value="Aset Tak Berwujud">Aset Tak Berwujud</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label fw-semibold">Deskripsi</label>
                            <input name="description" type="text" class="form-control" id="Deskripsi" placeholder="Deskripsi">
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="akun-asset" class="form-label fw-semibold">Kategori</label>
                            <select name="categories_id" class="form-select" id="akun-asset">
                                <option value="" selected disabled> Pilih </option>
                               @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="mb-3">
                            <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Akuisisi</label>
                            <input name="accuisition_date" type="date" class="form-control" id="tanggal-akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="biaya-akuisisi" class="form-label fw-semibold">Biaya Akuisisi</label>
                            <div class="input-group">
                                <input name="accuisition_cost" type="number" class="form-control"
                                    aria-label="Dollar amount (with dot and two decimal places)"
                                    id="biaya-akuisisi" placeholder="Biaya Akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="card-title mt-4 mb-4">Penyusutan</h4>
                <div class="checkbox mb-4">
                   <input name="non_depreciation" type="checkbox" class="form-check-input me-2 cursor-pointer" id="checkbox2" value="1" onchange="
                        const method = document.getElementById('Metode');
                        const depreciationAccount = document.getElementById('Akun penyusutan');
                        const usagePeriod = document.getElementById('Periode Penggunaan');
                        const accumulationDepreciationAccount = document.getElementById('Akumulasi Akun Penyusutan');
                        const usageValuePerYear = document.getElementById('Nilai Penyusutan');
                        const accumulationDepreciationValue = document.getElementById('Penyusutan');
                        const depreciationDate = document.getElementById('Tanggal Penyusutan');

                        if (this.checked) {
                            method.disabled = true;
                            method.value = '';
                            depreciationAccount.disabled = true;
                            depreciationAccount.value = '';
                            usagePeriod.disabled = true;
                            usagePeriod.value = '';
                            accumulationDepreciationAccount.disabled = true;
                            accumulationDepreciationAccount.value = '';
                            usageValuePerYear.disabled = true;
                            usageValuePerYear.value = '';
                            accumulationDepreciationValue.disabled = true;
                            accumulationDepreciationValue.value = '';
                            depreciationDate.disabled = true;
                            depreciationDate.value = '';
                        } else {
                            method.disabled = false;
                            depreciationAccount.disabled = false;
                            usagePeriod.disabled = false;
                            accumulationDepreciationAccount.disabled = false;
                            usageValuePerYear.disabled = false;
                            accumulationDepreciationValue.disabled = false;
                            depreciationDate.disabled = false;
                        }
                    ">
                        <label for="checkbox2">Assets non Depresiasi</label>
                    </div>
                <div class="mb-3">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Metode</label>
                            <select name="method" class="form-select" id="Metode">
                                <option value="" selected disabled> Pilih </option>
                                @foreach (\App\Enums\Method::cases() as $method)
                                    <option value="{{ $method->name }}">{{ $method->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Depresiasi Akun Penyusutan</label>
                            <select name="depreciation_account" class="form-select" id="Akun penyusutan">
                                <option value="" selected disabled> Pilih </option>
                                <option value="Penyusutan - Bangunan">Penyusutan - Bangunan</option>
                                <option value="Penyusutan - Building Improvements">Penyusutan - Building Improvementsi</option>
                                <option value="Penyusutan - Kendaraan">Penyusutan - Kendaraan</option>
                                <option value="Penyusutan - Mesin & Peralatan">Penyusutan - Mesin & Peralatan</option>
                                <option value="Penyusutan - Peralatan Kantor">Penyusutan - Peralatan Kantor</option>
                                <option value="Penyusutan - Aset Sewa Guna Usaha">Penyusutan - Aset Sewa Guna Usaha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Periode Penggunaan</label>
                        <div class="mb-3">
                            <input name="usage_period" type="number" class="form-control" id="Periode Penggunaan" placeholder="Periode Penggunaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Akumulasi  Depresiasi Akun Penyusutan</label>
                            <select name="accumulation_depreciation_account" class="form-select" id="Akumulasi Akun Penyusutan">
                                <option value="" selected disabled> Pilih </option>
                                <option value="Akumulasi Penyusutan - Bangunan">Akumulasi Penyusutan - Bangunan</option>
                                <option value="Akumulasi Penyusutan - Building Improvements">Akumulasi Penyusutan - Building Improvements</option>
                                <option value="Akumulasi penyusutan - Kendaraan">Akumulasi penyusutan - Kendaraan</option>
                                <option value="Akumulasi Penyusutan - Mesin & Peralatan">Akumulasi Penyusutan - Mesin & Peralatan</option>
                                <option value="Akumulasi Penyusutan - Peralatan Kantor">Akumulasi Penyusutan - Peralatan Kantor</option>
                                <option value="Akumulasi Penyusutan - Aset Sewa Guna Usaha">Akumulasi Penyusutan - Aset Sewa Guna Usaha</option>
                                <option value="Akumulasi Amortisasi">Akumulasi Amortisasi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Nilai Penyusutan Pertahun</label>
                        <div class="mb-3">
                            <input name="usage_value_per_year" type="text" class="form-control" id="Nilai Penyusutan" placeholder="Nilai Penyusutan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Total Penyusutan</label>
                            <!-- <input name="accumulation_depreciation_value" type="text" class="form-control" id="Penyusutan" placeholder="Total Penyusutan"> -->
                        </div>
                    </div>
                </div>
                <div class="mb-4 mt-2">
                    <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Penyusutan</label>
                    <input name="depreciation_date" type="date" class="form-control" id="Tanggal Penyusutan">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">simpan</button>
                    <a href="/assets" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

