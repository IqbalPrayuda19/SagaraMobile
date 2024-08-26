<section class="section pt-3 pb-3">
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
                            <label for="detail-asset" class="form-label">Detail Asset</label>
                            <input type="text" class="form-control" id="detail-asset" placeholder="Nama Asset">
                        </div>
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label">Nomor Asset</label>
                            <input type="text" class="form-control" id="nomor-asset" placeholder="Nomor Asset (opsional)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal-akuisisi" class="form-label">Tanggal Akuisisi</label>
                            <input type="date" class="form-control" id="tanggal-akuisisi">
                        </div>
                        <div class="mb-3">
                            <label for="biaya-akuisisi" class="form-label">Biaya Akuisisi</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <span class="input-group-text">000</span>
                                <input type="text" class="form-control"
                                    aria-label="Dollar amount (with dot and two decimal places)"
                                    id="biaya-akuisisi" placeholder="Biaya Akuisisi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="akun-asset" class="form-label">Akun Asset Tetap</label>
                            <select class="form-select" id="akun-asset">
                                <option value="Tanah">Asset Tetap - Tanah</option>
                                <option value="Mesin Produksi">Asset Tetap - Mesin Produksi</option>
                                <option value="Kendaraan Operasional">Asset Tetap - Kendaraan Operasional</option>
                                <option value="Romboid">Asset Tetap - Peralatan Kantor</option>
                                <option value="Trapeze">Asset Tetap - Bangunan </option>
                                <option value="Traible">Asset Tetap - Komputer dan Peralatan IT</option>
                                <option value="polygon">Asset Tetap - Bangunan</option>
                                <option value="polygon">Asset Tak Berwujud</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label">Akun Dikreditkan</label>
                            <select class="form-select" id="akun-dikreditkan">
                                <option value="Tanah">Asset Tetap - Tanah</option>
                                <option value="Mesin Produksi">Asset Tetap - Mesin Produksi</option>
                                <option value="Kendaraan Operasional">Asset Tetap - Kendaraan Operasional</option>
                                <option value="Romboid">Asset Tetap - Peralatan Kantor</option>
                                <option value="Trapeze">Asset Tetap - Bangunan </option>
                                <option value="Traible">Asset Tetap - Komputer dan Peralatan IT</option>
                                <option value="polygon">Asset Tetap - Bangunan</option>
                                <option value="polygon">Asset Tak Berwujud</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="Deskripsi" placeholder="deskripsi">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor-asset" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="Tags" placeholder="Tags">
                        </div>
                    </div>
                </div>
                <h4 class="card-title mt-2">Penyusutan</h4>
                <div class="row g-3 mt-2">
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
                            <label for="akun-dikreditkan" class="form-label">Akun Penyusutan</label>
                            <select class="form-select" id="Akun penyusutan">
                                <option value="square">Iklan Dan Promosi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label">Nilai/Tahun</label>
                            <input type="text" class="form-control" id="Penyusutan" placeholder="Nilai/Tahun">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akun-dikreditkan" class="form-label">Akumulasi Akun Penyusutan</label>
                            <select class="form-select" id="Akumulasi Akun Penyusutan">
                                <option value="square">Akumulasi Penyusutan-Bangunan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="akun-dikreditkan" class="form-label">Masa Manfaat</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="Penyusutan" placeholder="Masa Manfaat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail-asset" class="form-label">Akumulasi Penyusutan</label>
                            <input type="text" class="form-control" id="Penyusutan" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-2">
                    <label for="tanggal-akuisisi" class="form-label">Pada Tanggal</label>
                    <input type="date" class="form-control" id="Tanggal Penyusutan">
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
<section>

