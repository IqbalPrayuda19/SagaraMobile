<div class="col-12 px-5 py-5" style="font-family: 'Poppins', sans-serif;">
    <div class="card px-5">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h3 class="card-title">History</h3>
            </div>
        </div>
        <div class="table-responsive" style="overflow-x: auto; display: block;">
            <table class="table table-nowrap" style="overflow-x: auto; min-width: max-content;">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-bold-500 text-center">Tanggal</th>
                        <th class="text-bold-500 text-center">Aksi</th>
                        <th class="text-bold-500 text-center">No.Transaksi</th>
                        <th class="text-bold-500 text-center">Akun</th>
                        <th class="text-bold-500 text-center">Debit</th>
                        <th class="text-bold-500 text-center">Kredit</th>
                        <th class="text-bold-500 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($histories) && count($histories) > 0)
                        @foreach($histories as $history)
                            <tr>
                                <td class="text-bold-500 text-center">{{ $history->created_at->format('d-m-Y H:i:s') }}</td>
                                <td class="text-bold-500 text-center">
                                    @if($history->action == 'created')
                                        <span class="badge bg-success">Dibuat</span>
                                    @elseif($history->action == 'updated')
                                        <span class="badge bg-info">Diperbarui</span>
                                    @elseif($history->action == 'deleted')
                                        <span class="badge bg-danger">Dihapus</span>
                                    @elseif($history->action == 'restored')
                                        <span class="badge bg-warning">Dipulihkan</span>
                                    @endif
                                </td>
                                <td class="text-bold-500 text-center">{{ $history->transaction_number }}</td>
                                <td class="text-bold-500 text-center">{{ $history->account }}</td>
                                <td class="text-bold-500 text-center">
                                    @if($history->debit > 0)
                                        Rp. {{ number_format($history->debit, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-bold-500 text-center">
                                    @if($history->credit > 0)
                                        Rp. {{ number_format($history->credit, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-bold-500 text-center">
                                    <div class="d-flex justify-content-center">
                                        @if($history->action == 'deleted')
                                            <form action="{{ route('restore', $history->asset_uuid) }}" method="POST" class="me-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-link p-0" title="Pulihkan">
                                                    <i class="badge-circle badge-circle-light-secondary text-warning font-medium-1" data-feather="refresh-cw"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('deleteHistory', $history->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link p-0" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                                                <i class="badge-circle badge-circle-light-secondary text-danger font-medium-1" data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-bold-500">Tidak ada history</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>