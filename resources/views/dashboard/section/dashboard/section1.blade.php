<div class="px-5 py-5" style="font-family: 'Poppins', sans-serif;">
    <h1 class="text-white">Welcome back, {{ auth()->user()->name }}</h1>

    <div class="d-flex flex-row gap-4 mt-4">
        <a href="/asset" class="table-responsive bg-white p-1 rounded-4 shadow" style="max-width: 500px; width: 100%; max-height: 200px;">
            <div class="table-responsive bg-white p-1 rounded shadow">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Nama Assets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td class="text-start">{{ $asset->name }}</td>
                                <td class="text-start">Rp {{ number_format($asset->accuisition_cost, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-start text-muted">Tidak ada assets</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </a>

        {{-- Tabel 2 --}}
        <a href="/history" class="table-responsive bg-white p-1 rounded-4 shadow" style="max-width: 500px; width: 100%; max-height: 200px;">
            <div class="table-responsive bg-white p-1 rounded shadow" style="max-width: 500px; width: 100%;">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">History</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history->take(3) as $transaction)
                            <tr>
                                <td class="text-start">{{ $transaction }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-start text-muted">Tidak ada history</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </a>
    </div>
</div>
