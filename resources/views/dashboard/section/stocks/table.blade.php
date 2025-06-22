<div class="col-12 px-5 py-5" style="font-family: 'Poppins', sans-serif;">
    <div class="card px-5">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h3 class="card-title">Assets</h3>
            </div>
            <form action="{{ route('getIndex') }}" method="GET" class="mx-2 w-50">
                <div class="input-group border border-1 border-secondary rounded">
                    <input type="text" name="search" class="form-control" placeholder="Cari aset..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary border-0" type="submit">
                            <i data-feather="search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="px-2">
                <a href="/create" class="px-2"><i data-feather="plus"></i></a>
            </div>
        </div>
        <div class="table-responsive" style="overflow-x: auto; display: block;">
            <table class="table table-nowrap" style="overflow-x: auto; min-width: max-content;">
                <thead class="thead-dark">
                    <tr style="padding-right: 10px;">
                        <th class="text-bold-500 text-center">Nama</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Lokasi</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Kategori</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Nomor Custom</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Aset Tetap</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Deskripsi</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Tanggal Akuisisi</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Biaya Akuisisi</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Metode</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Periode Penggunaan</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Nilai Penyusutan Pertahun</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Depresiasi Akun Penyusutan</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Akumulasi Depresiasi Akun Penyusutan</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Total Penyusutan</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Tanggal Penyusutan</th>
                        <th class="text-bold-500 text-center">-</th>
                        <th class="text-bold-500 text-center">Aksi</th>
                    </tr>
                </thead>
                @if(count($assets) > 0)
                <tbody>
                    @foreach ($assets as $asset )
                    <tr>
                        <td class="text-bold-500 text-center">{{ $asset->name}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->locations->name}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->categories->name}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->location_id}} - {{ $asset->categories_id}} - {{\Carbon\Carbon::parse( $asset->accuisition_date )->format('y')}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->account_fixed_asset}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->description}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->accuisition_date}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">Rp. {{ number_format($asset->accuisition_cost, 0, ',', '.') }}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->method}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->usage_period}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->usage_value_per_year}} % </td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->depreciation_account}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->accumulation_depreciation_account}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">Rp. {{ number_format($asset->accumulation_depreciation_value, 0, ',', '.') }}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">{{ $asset->depreciation_date}}</td>
                        <td class="text-bold-500 text-center">-</td>
                        <td class="text-bold-500 text-center">
                        <form action="{{route('destroy', $asset->uuid)}}" method="POST">
                            @csrf
                            <a href="{{route('getEdit', $asset->uuid)}}"><i class="badge-circle badge-circle-light-secondary text-success font-medium-1 mx-1" style="width:18px; height:18px;" data-feather="edit"></i></a>
                            <button type="submit" onclick="return confirmDelete(event, this.form)" class="border-0 bg-white">
                            <i class=" border-0 badge-circle badge-circle-light-secondary text-danger font-medium-1" style="width:18px; height:18px;" data-feather="trash"></i>
                            </button>
                            <script>
                                function confirmDelete(event, form) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Anda yakin?',
                                        text: 'Data aset akan dihapus!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, hapus!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            form.submit();
                                        }
                                    });
                                    return false;
                                }
                            </script>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <tbody>
                    <tr>
                        <td colspan="17" class="text-center text-bold-500">Tidak ada assets</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>

