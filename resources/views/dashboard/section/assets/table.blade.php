<div class="col-12 px-5 py-5" style="font-family: 'Poppins', sans-serif;">
                <div class="card px-5">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3 class="card-title">Assets</h3>
                        </div>
                        <div class="px-2">
                            <a href="/create" class="px-2"><i data-feather="plus"></i></a>
                            <i data-feather="folder-plus"></i>
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow-x: auto; display: block;">
                        <table class="table table-nowrap" style="overflow-x: auto; min-width: max-content;">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-bold-500 text-center">Nama</th>
                                    <th class="text-bold-500 text-center">Lokasi</th>
                                    <th class="text-bold-500 text-center">Kategori</th>
                                    <th class="text-bold-500 text-center">Nomor Custom</th>
                                    <th class="text-bold-500 text-center">Aset Tetap</th>
                                    <th class="text-bold-500 text-center">Deskripsi</th>
                                    <th class="text-bold-500 text-center">Tanggal Akuisisi</th>
                                    <th class="text-bold-500 text-center">Biaya Akuisisi</th>
                                    <th class="text-bold-500 text-center">Metode</th>
                                    <th class="text-bold-500 text-center">Periode Penggunaan</th>
                                    <th class="text-bold-500 text-center">Nilai Penyusutan Pertahun</th>
                                    <th class="text-bold-500 text-center">depresiasi akun penyusutan</th>
                                    <th class="text-bold-500 text-center">akumulasi depresiasi akun penyusutan</th>
                                    <th class="text-bold-500 text-center">total penyusutan</th>
                                    <th class="text-bold-500 text-center">tanggal penyusutan</th>
                                    <th class="text-bold-500 text-center">Aksi</th>
                                </tr>
                            </thead>
                            @if(count($assets) > 0)
                            <tbody>
                                @foreach ($assets as $asset )
                                <tr>
                                    <td class="text-bold-500 text-center">{{ $asset->name}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->location_id}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->categories_id}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->location_id}} - {{ $asset->categories_id}} - {{\Carbon\Carbon::parse( $asset->accuisition_date )->format('y')}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->account_fixed_asset}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->description}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->accuisition_date}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->accuisition_cost}} </td>
                                    <td class="text-bold-500 text-center">{{ $asset->method}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->usage_period}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->usage_value_per_year}} % </td>
                                    <td class="text-bold-500 text-center">{{ $asset->depreciation_account}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->accumulation_depreciation_account}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->accumulation_depreciation_value}}</td>
                                    <td class="text-bold-500 text-center">{{ $asset->depreciation_date}}</td>
                                    <td class="text-bold-500 text-center">
                                    <form action="{{route('destroy', $asset->uuid)}}" method="POST">
                                        @csrf
                                        <a href="{{route('getEdit', $asset->uuid)}}"><i class="badge-circle badge-circle-light-secondary text-success font-medium-1 mx-1" data-feather="edit"></i></a>
                                        <button type="submit" onclick="return confirm('Hapus Data Aset?')"><i class="badge-circle badge-circle-light-secondary text-danger font-medium-1" data-feather="trash"></i></button>
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
            </div>
        </div>

