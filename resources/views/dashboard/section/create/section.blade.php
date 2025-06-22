<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/asset" class="position-absolute top-0 start-0 mt-3 ms-3">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body px-4 py-2">
            <form action="{{route('postStore')}}" method="POST">
                @csrf
                <h4 class="card-title mt-5">Penyimpanan Aset Baru</h4>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Nama aset<span class="text-danger mx-3">*</span></label>
                            <input name="name" type="text" class="form-control" id="nama aset" placeholder="Nama Aset" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label fw-semibold" required>Lokasi<span class="text-danger mx-3">*</span></label>
                            <select name="location_id" class="form-select" id="akun-asset" required>
                                <option value="" selected disabled> Pilih </option>
                                @foreach ($locations as $location )
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nomor-asset" class="form-label fw-semibold">Akun Aset Tetap<span class="text-danger mx-3">*</span></label>
                            <select name="account_fixed_asset" class="form-select" id="akun-asset-tetap" required>
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
                            <label for="nomor-asset" class="form-label fw-semibold">Deskripsi<span class="text-danger mx-3">*</span></label>
                            <input name="description" type="text" class="form-control" id="Deskripsi" placeholder="Deskripsi" required>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="akun-asset" class="form-label fw-semibold">Kategori<span class="text-danger mx-3">*</span></label>
                            <select name="categories_id" class="form-select" id="akun-asset" required>
                                <option value="" selected disabled> Pilih </option>
                               @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="mb-3">
                            <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Akuisisi<span class="text-danger mx-3">*</span></label>
                            <input name="accuisition_date" type="date" class="form-control" id="tanggal-akuisisi" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="biaya-akuisisi" class="form-label fw-semibold">Biaya Akuisisi<span class="text-danger mx-3">*</span></label>
                            <div class="input-group">
                                <input name="accuisition_cost" type="text" class="form-control"
                                    aria-label="Dollar amount (with dot and two decimal places)"
                                    id="biaya-akuisisi" placeholder="Biaya Akuisisi" required>
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
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Metode<span class="text-danger mx-3">*</span></label>
                            <select name="method" class="form-select" id="Metode" required>
                                <option value="" selected disabled> Pilih </option>
                                @foreach (\App\Enums\Method::cases() as $method)
                                    <option value="{{ $method->name }}">{{ $method->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Depresiasi Akun Penyusutan<span class="text-danger mx-3">*</span></label>
                            <select name="depreciation_account" class="form-select" id="Akun penyusutan" required>
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
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Periode Penggunaan<span class="text-danger mx-3">*</span></label>
                        <div class="mb-3">
                            <input name="usage_period" type="number" class="form-control" id="Periode Penggunaan" placeholder="Periode Penggunaan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label fw-semibold">Akumulasi  Depresiasi Akun Penyusutan<span class="text-danger mx-3">*</span></label>
                            <select name="accumulation_depreciation_account" class="form-select" required id="Akumulasi Akun Penyusutan">
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
                        <label for="akun-dikreditkan" class="form-label fw-semibold">Nilai Penyusutan Pertahun<span class="text-danger mx-3">*</span></label>
                        <div class="mb-3">
                            <input name="usage_value_per_year" type="text" class="form-control" id="Nilai Penyusutan" placeholder="Nilai Penyusutan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label fw-semibold">Total Penyusutan<span class="text-danger mx-3">*</span></label>
                            <input name="accumulation_depreciation_value" type="text" class="form-control" id="Penyusutan" placeholder="Total Penyusutan" required>
                        </div>
                    </div>
                </div>
                <div class="mb-4 mt-2">
                    <label for="tanggal-akuisisi" class="form-label fw-semibold">Tanggal Penyusutan<span class="text-danger mx-3">*</span></label>
                    <input name="depreciation_date" type="date" class="form-control" id="Tanggal Penyusutan" required>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">simpan</button>
                    <a href="/asset" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi input fields
    const inputIds = ['biaya-akuisisi', 'Nilai Penyusutan', 'Penyusutan'];
    const acquisitionCostInput = document.getElementById('biaya-akuisisi');
    const methodSelect = document.getElementById('Metode');
    const usagePeriodInput = document.getElementById('Periode Penggunaan');
    const depreciationValueInput = document.getElementById('Nilai Penyusutan');
    const accumulatedDepreciationInput = document.getElementById('Penyusutan');
    const nonDepreciationCheckbox = document.getElementById('checkbox2');
    const acquisitionDateInput = document.getElementById('tanggal-akuisisi');
    const depreciationDateInput = document.getElementById('Tanggal Penyusutan');

    // Format angka dengan titik sebagai pemisah ribuan
    inputIds.forEach(function(id) {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', function () {
                let value = this.value.replace(/[^\d,]/g, ''); // Hapus karakter selain angka dan koma
                let [integerPart, decimalPart] = value.split(','); // Pisahkan bagian integer dan desimal
                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format angka dengan titik setiap 3 digit
                if (decimalPart) {
                    decimalPart = decimalPart.slice(0, 2); // Ambil hanya dua digit desimal
                }
                // Gabungkan kembali integer dan desimal
                this.value = decimalPart ? `${integerPart},${decimalPart}` : integerPart;
            });
        }
    });

    // Fungsi untuk menghitung tanggal penyusutan berdasarkan tanggal akuisisi dan periode penggunaan
    function updateDepreciationDate() {
        if (nonDepreciationCheckbox.checked) {
            depreciationDateInput.value = '';
            return;
        }

        const acquisitionDate = new Date(acquisitionDateInput.value);
        const usagePeriod = parseInt(usagePeriodInput.value);

        if (!isNaN(acquisitionDate.getTime()) && !isNaN(usagePeriod) && usagePeriod > 0) {
            const depreciationDate = new Date(acquisitionDate);
            depreciationDate.setFullYear(depreciationDate.getFullYear() + usagePeriod);
            
            // Format tanggal ke YYYY-MM-DD untuk input date
            const year = depreciationDate.getFullYear();
            const month = String(depreciationDate.getMonth() + 1).padStart(2, '0');
            const day = String(depreciationDate.getDate()).padStart(2, '0');
            depreciationDateInput.value = `${year}-${month}-${day}`;
        }
    }

    // Fungsi untuk menghitung nilai penyusutan dengan metode Straight Line (5%)
    function calculateStraightLineDepreciation(acquisitionCost) {
        // Straight Line dengan persentase tetap 5%
        return acquisitionCost * 0.05;
    }

    // Fungsi untuk menghitung nilai penyusutan dengan metode Reducing Balance (10%)
    function calculateReducingBalanceDepreciation(acquisitionCost) {
        // Reducing Balance dengan persentase tetap 10%
        return acquisitionCost * 0.10;
    }

    // Fungsi untuk memperbarui nilai penyusutan berdasarkan metode dan biaya akuisisi
    function updateDepreciationValues() {
        if (nonDepreciationCheckbox.checked) {
            depreciationValueInput.value = '';
            accumulatedDepreciationInput.value = '';
            return;
        }

        const acquisitionCostStr = acquisitionCostInput.value.replace(/\./g, '').replace(',', '.');
        const acquisitionCost = parseFloat(acquisitionCostStr);

        if (isNaN(acquisitionCost)) {
            return;
        }

        let annualDepreciation = 0;

        if (methodSelect.value === 'STRAIGHT_LINE') {
            annualDepreciation = calculateStraightLineDepreciation(acquisitionCost);
        } else if (methodSelect.value === 'REDUCING_BALANCE') {
            annualDepreciation = calculateReducingBalanceDepreciation(acquisitionCost);
        }

        // Format nilai penyusutan
        depreciationValueInput.value = Math.round(annualDepreciation).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        accumulatedDepreciationInput.value = depreciationValueInput.value; // Untuk tahun pertama, nilai akumulasi sama dengan nilai penyusutan
    }

    // Tambahkan event listeners
    if (acquisitionCostInput && methodSelect && usagePeriodInput && acquisitionDateInput) {
        // Update tanggal penyusutan ketika tanggal akuisisi atau periode penggunaan berubah
        acquisitionDateInput.addEventListener('change', updateDepreciationDate);
        usagePeriodInput.addEventListener('change', function() {
            updateDepreciationDate();
            updateDepreciationValues();
        });
        
        // Update nilai penyusutan ketika biaya akuisisi atau metode berubah
        acquisitionCostInput.addEventListener('change', updateDepreciationValues);
        methodSelect.addEventListener('change', updateDepreciationValues);
        
        // Update semua nilai ketika checkbox non-depresiasi berubah
        nonDepreciationCheckbox.addEventListener('change', function() {
            if (this.checked) {
                methodSelect.disabled = true;
                methodSelect.value = '';
                usagePeriodInput.disabled = true;
                usagePeriodInput.value = '';
                depreciationValueInput.disabled = true;
                depreciationValueInput.value = '';
                accumulatedDepreciationInput.disabled = true;
                accumulatedDepreciationInput.value = '';
                depreciationDateInput.disabled = true;
                depreciationDateInput.value = '';
            } else {
                methodSelect.disabled = false;
                usagePeriodInput.disabled = false;
                depreciationValueInput.disabled = false;
                accumulatedDepreciationInput.disabled = false;
                depreciationDateInput.disabled = false;
                
                // Perbarui nilai-nilai jika data sudah ada
                updateDepreciationDate();
                updateDepreciationValues();
            }
        });
    }
});

</script>


