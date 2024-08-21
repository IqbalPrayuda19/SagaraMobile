@if ($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <!-- Container Start -->



    <div class="container mt-3">
        <div class="card-header border-0 pt-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Tambah Sarung</span>
                <br>
            </h3>
        </div>

        <div class="class mb-3">
            <div class="card-header border-0">
                <div class="class-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <div class="form-group mt-3 d-flex">
                                <strong>Name Asset   </strong>
                                <input type="text" name="nama_sarung" class="form-control ms-4" style="width: 25vw; height: 30px" placeholder="Nama Asset" value="{{old('nama_sarung')}}">
                            </div>
                        </div>

                        <div class="d-flex">
                            <strong for="ukuran_sarung">Location</strong>
                            <br>
                                <select class="btn border-dark dropdown-toggle bg-white mb-3 ms-5 border-0" style="width: 7vw; height: 30px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="ukuran_sarung" name="ukuran_sarung">
                                    <option class="dropdown-item" value="S">Server</option>
                                    <option class="dropdown-item" value="M">Toko KBB</option>
                                    <option class="dropdown-item" value="L">Toko KBS</option>
                                    <option class="dropdown-item" value="L">Toko KBU</option>
                                    <option class="dropdown-item" value="L">Toko KBS</option>
                                </select>
                        </div>

                        <div class="d-flex">
                            <strong for="ukuran_sarung">Category</strong>
                            <br>
                                <select class="btn border-dark dropdown-toggle bg-white mb-3 mx-5 border-0" style="width: 7vw; height: 30px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="ukuran_sarung" name="ukuran_sarung">
                                    <option class="dropdown-item" value="S">Tanah</option>
                                    <option class="dropdown-item" value="M">Bangunan</option>
                                    <option class="dropdown-item" value="L">Building Improvements</option>
                                    <option class="dropdown-item" value="L">Kendaraan</option>
                                    <option class="dropdown-item" value="L">Mesin & Peralatan</option>
                                    <option class="dropdown-item" value="L">Peralatan Kantor</option>
                                    <option class="dropdown-item" value="L">Aset tak Berwujud</option>
                                    <option class="dropdown-item" value="L">Aset Sewa Guna Usaha</option>
                                </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-group mb-3">
                                <strong>Custom Number  :</strong>
                                <input type="number" name="harga_sarung" class="form-control mt-3" placeholder="Harga Sarung" value="{{old('harga_sarung')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <strong>Deskripsi  :</strong>
                                <textarea class="form-control mt-3" name="deskripsi_sarung" id="exampleFormControlTextarea1" value="{{old('deskripsi_sarung')}}" placeholder="Tulis Deskripsi" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Motif  :</strong>
                                <input type="file" name="motif_sarung" class="form-control" placeholder="Gambar">
                            </div>
                        </div>
                        <br>
                        <a href="" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-success mx-2 ">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
