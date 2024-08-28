<section class=" pt-3 pb-3">
    <div class="card mx-auto" style="max-width: 900px;">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-2">
        </div>
        <a href="/assets" class="position-absolute top-0 start-0 mt-2 ms-2">
            <i data-feather="arrow-left" class="me-2" style="font-size: 2rem;"></i>
        </a>
        <div class="card-body px-4 py-2">
            <form>
                <h4 class="card-title mt-4">Penyimpanan Aset Baru</h4>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label">Nama Aset</label>
                            <input type="text" class="form-control" id="nama aset" placeholder="Nama Aset">
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label">Lokasi</label>
                            <select class="form-select" id="akun-asset">
                                <option value="Toko KBB">Toko KBB</option>
                                <option value="Toko KBS">Toko KBS</option>
                                <option value="Toko KBU">Toko KBU</option>
                                <option value="Toko KBS">Toko KBS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nomor-asset" class="form-label">Akun Aset Tetap</label>
                            <select class="form-select" id="akun-asset-tetap">
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
                            <label for="nomor-asset" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="Deskripsi" placeholder="Deskripsi">
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="akun-asset" class="form-label">Kategori</label>
                            <select class="form-select" id="akun-asset">
                                <option value="Tanah">Tanah</option>
                                <option value="Bangunan">Bangunan</option>
                                <option value="Building Improvements">Building Improvements</option>
                                <option value="Kendaraan">Kendaraan</option>
                                <option value="Mesin dan Peralatan">Mesin dan Peralatan</option>
                                <option value="Peralatan Kantor">Peralatan Kantor</option>
                                <option value="Aset Tak Berwujud">Aset Tak Berwujud</option>
                                <option value="Aset Sewa Guna Usaha">Aset Sewa Guna Usaha</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="mb-3">
                            <label for="tanggal-akuisisi" class="form-label">Tanggal Akuisisi</label>
                            <input type="date" class="form-control" id="tanggal-akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label">Nomor Custom</label>
                            <input type="text" class="form-control" id="Nomor Custom" placeholder="Nomor custom">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="biaya-akuisisi" class="form-label">Biaya Akuisisi</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    aria-label="Dollar amount (with dot and two decimal places)"
                                    id="biaya-akuisisi" placeholder="Biaya Akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="card-title mt-2">Penyusutan</h4>
                <div class="checkbox">
                    <input type="checkbox" class="form-check-input" id="checkbox2">
                        <label for="checkbox2">Assets non Depresiasi</label>
                    </div>
                <div class="mb-3">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label">Metode</label>
                            <select class="form-select" id="Metode">
                                <option value="square">Straight Line</option>
                                <option value="rectangle">Reducing balance</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label">Depresiasi Akun Penyusutan</label>
                            <select class="form-select" id="Akun penyusutan">
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
                        <label for="akun-dikreditkan" class="form-label">Masa Manfaat/Masa Guna</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="Masa Manfaat" placeholder="Masa Manfaat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label">Akumulasi  Depresiasi Akun Penyusutan</label>
                            <select class="form-select" id="Akumulasi Akun Penyusutan">
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
                        <label for="akun-dikreditkan" class="form-label">Nilai Penyusutan Pertahun</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="Nilai Penyusutan" placeholder="Nilai Penyusutan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label">Total Penyusutan</label>
                            <input type="text" class="form-control" id="Penyusutan" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-2">
                    <label for="tanggal-akuisisi" class="form-label">Tanggal Penyusutan</label>
                    <input type="date" class="form-control" id="Tanggal Penyusutan">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">simpan</button>
                    <button type="button" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>

