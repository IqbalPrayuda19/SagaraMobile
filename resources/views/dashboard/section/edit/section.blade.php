<section class=" pt-5 pb-3" style="font-family: 'Poppins', sans-serif;">
    <div class="card mx-auto" style="max-width: 75vw;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/asset" class="position-absolute top-0 start-0 mt-3 ms-3">
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
                            <select name="categories_id" class="form-select" id="kategori-asset">
                                <option value="" disabled> Pilih </option>
                            @foreach ($categories as $category )
                                    <option value="{{$category->id}}" {{$assets->categories_id == $category->id ? 'selected' : ''}} data-percentage="{{$category->percentage}}">
                                        {{$category->name}} @if($category->percentage > 0) ({{ number_format($category->percentage, $category->percentage == floor($category->percentage) ? 0 : 1, ',', '.') }}%) @endif
                                    </option>
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
                   <input name="non_depreciation" {{$assets->non_depreciation == 1 ? 'checked':''}} type="checkbox" class="form-check-input me-2 cursor-pointer" id="checkbox2" value="1" onchange="
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
                                <option value="" disabled> Pilih </option>
                                @foreach (\App\Enums\Method::cases() as $method)
                                    <option value="{{ $method->name }}" {{ ($assets->method === $method || $assets->method == $method->value || $assets->method == $method->name) ? 'selected' : '' }}>
                                        {{ $method->value }}
                                    </option>
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
</section>

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

    if (nonDepreciationCheckbox && nonDepreciationCheckbox.checked) {
        nonDepreciationCheckbox.dispatchEvent(new Event('change'));
    }

    // Format angka dengan titik sebagai pemisah ribuan
    inputIds.forEach(function(id) {
        const input = document.getElementById(id);
        if (input) {
            // Fungsi untuk memformat nilai
            const formatValue = (val) => {
                if (!val) return '';
                let value = val.toString().replace(/[^\d,]/g, ''); // Hapus karakter selain angka dan koma
                let [integerPart, decimalPart] = value.split(','); // Pisahkan bagian integer dan desimal
                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format angka dengan titik setiap 3 digit
                if (decimalPart) {
                    decimalPart = decimalPart.slice(0, 2); // Ambil hanya dua digit desimal
                }
                return decimalPart ? `${integerPart},${decimalPart}` : integerPart;
            };

            // Format nilai awal saat halaman dimuat
            input.value = formatValue(input.value);

            // Tambahkan event listener untuk memformat saat pengetikan
            input.addEventListener('input', function () {
                this.value = formatValue(this.value);
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

    const categorySelect = document.getElementById('kategori-asset');

    // Fungsi untuk mendapatkan rate dari kategori yang dipilih
    function getDepreciationRate() {
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const percentage = selectedOption ? parseFloat(selectedOption.getAttribute('data-percentage')) : 0;
        return isNaN(percentage) ? 0 : percentage / 100;
    }

    // Fungsi untuk menghitung nilai penyusutan dengan metode Straight Line
    function calculateStraightLineDepreciation(acquisitionCost, rate) {
        return acquisitionCost * rate;
    }

    // Fungsi untuk menghitung nilai penyusutan dengan metode Reducing Balance
    function calculateReducingBalanceDepreciation(acquisitionCost, rate) {
        return acquisitionCost * rate;
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
        const usagePeriod = parseInt(usagePeriodInput.value) || 1; // Gunakan 1 jika tidak ada nilai
        const rate = getDepreciationRate();

        if (isNaN(acquisitionCost) || isNaN(rate)) {
            return;
        }

        // 1. Hitung Nilai Penyusutan Bulanan (Dasar aturan pajak)
        const monthlyDepreciation = (acquisitionCost * rate) / 12;

        // 2. Nilai Penyusutan Pertahun (Jumlah dari 12 bulan)
        let annualDepreciation = monthlyDepreciation * 12;

        // 3. Total Penyusutan (Berdasarkan jumlah bulan dalam periode tahun)
        const totalMonths = usagePeriod * 12;
        let totalDepreciation = 0;

        if (methodSelect.value === 'STRAIGHT_LINE') {
            totalDepreciation = monthlyDepreciation * totalMonths;
        } else if (methodSelect.value === 'REDUCING_BALANCE') {
            let remainingValue = acquisitionCost;
            totalDepreciation = 0;

            // Perhitungan saldo menurun berbasis bulan
            for (let i = 0; i < totalMonths; i++) {
                const monthRate = rate / 12; // Persentase bulanan
                const monthDep = remainingValue * monthRate;
                totalDepreciation += monthDep;
                remainingValue -= monthDep;
            }
        }

        // Format nilai penyusutan
        depreciationValueInput.value = Math.round(annualDepreciation).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        accumulatedDepreciationInput.value = Math.round(totalDepreciation).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Tambahkan event listeners
    if (acquisitionCostInput && methodSelect && usagePeriodInput && acquisitionDateInput) {
        // Update tanggal penyusutan ketika tanggal akuisisi atau periode penggunaan berubah
        acquisitionDateInput.addEventListener('change', updateDepreciationDate);
        usagePeriodInput.addEventListener('input', function() {
            updateDepreciationDate();
            updateDepreciationValues();
        });

        // Update nilai penyusutan ketika biaya akuisisi, metode, atau kategori berubah
        acquisitionCostInput.addEventListener('input', updateDepreciationValues);
        methodSelect.addEventListener('change', updateDepreciationValues);
        categorySelect.addEventListener('change', function() {
            const percentage = parseFloat(this.options[this.selectedIndex].getAttribute('data-percentage')) || 0;
            if (percentage === 0) {
                nonDepreciationCheckbox.checked = true;
                nonDepreciationCheckbox.dispatchEvent(new Event('change'));
            } else {
                nonDepreciationCheckbox.checked = false;
                nonDepreciationCheckbox.dispatchEvent(new Event('change'));
            }
            updateDepreciationValues();
        });

        // Nonaktifkan input tanggal penyusutan karena akan dihitung otomatis
        depreciationDateInput.readOnly = true;
    }
});
</script>

