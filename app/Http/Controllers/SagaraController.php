<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Categories;
use App\Models\Locations;
use App\Enums\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\AssetHistory;

class SagaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex(Request $request)
    {
        //
        // $assets = Assets::all();
        // dd ($assets);
        $search = $request->input('search');

        $assets = \App\Models\Assets::with(['categories', 'locations'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('custom_number', 'like', "%{$search}%")
                      ->orWhere('account_fixed_asset', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('method', 'like', "%{$search}%")
                      ->orWhere('depreciation_account', 'like', "%{$search}%")
                      ->orWhere('accumulation_depreciation_account', 'like', "%{$search}%")
                      // Relational search
                      ->orWhereHas('categories', function ($cat) use ($search) {
                          $cat->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('locations', function ($loc) use ($search) {
                          $loc->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->get();
        return view ('dashboard.section.stocks.index', compact('assets','search'));
    }

    public function getDashboardContent()
    {
        $assets = Assets::select('name', 'accuisition_cost')->take(5)->get();
        $history =AssetHistory::pluck('transaction_number');

        return view('dashboard.section.dashboard.index', compact('assets','history'));
    }


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response

     */
    public function getCreate()
    {
        //
        return view('dashboard.section.create.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        try {
            // Menghapus titik pemisah ribuan
            $request->merge([
                'accuisition_cost' => (int) str_replace(['.', ','], '', $request->accuisition_cost),
                'usage_value_per_year' => (int) str_replace(['.', ','], '', $request->usage_value_per_year),
                'accumulation_depreciation_value' => (int) str_replace(['.', ','], '', $request->accumulation_depreciation_value)
            ]);

            $request->validate([
                'name' => 'required|string',
                'location_id' => 'required|exists:locations,id',
                'categories_id' => 'required|exists:categories,id',
                'account_fixed_asset' => 'nullable|string',
                'description' => 'required|string',
                'accuisition_date' => 'nullable|date',
                'accuisition_cost' => 'nullable|integer',
                'usage_period' => 'nullable|integer',
                'usage_value_per_year' => 'nullable|integer',
                'depreciation_account' => 'nullable|string',
                'accumulation_depreciation_account' => 'nullable|string',
                'accumulation_depreciation_value' => 'nullable|integer',
                'depreciation_date' => 'nullable|date',
            ]);

            // Hitung periode penggunaan dari tanggal akuisisi dan tanggal penyusutan
            if ($request->has('accuisition_date') && $request->has('depreciation_date') && !$request->filled('usage_period')) {
                $acquisitionDate = \Carbon\Carbon::parse($request->accuisition_date);
                $depreciationDate = \Carbon\Carbon::parse($request->depreciation_date);
                
                // Hitung selisih dalam tahun
                $usagePeriod = $depreciationDate->diffInYears($acquisitionDate);
                
                // Update nilai usage_period
                $request->merge(['usage_period' => $usagePeriod]);
            }

            // Hitung tanggal penyusutan dari tanggal akuisisi dan periode penggunaan
            if ($request->has('accuisition_date') && $request->has('usage_period') && !$request->filled('depreciation_date')) {
                $acquisitionDate = \Carbon\Carbon::parse($request->accuisition_date);
                
                // Tambahkan periode penggunaan dalam tahun
                $depreciationDate = $acquisitionDate->copy()->addYears($request->usage_period);
                
                // Update nilai depreciation_date
                $request->merge(['depreciation_date' => $depreciationDate->format('Y-m-d')]);
            }

            // Mengambil nilai checkbox (default 0 jika tidak dicentang)
            $nonDepreciation = $request->input('non_depreciation', 0);
            $uuid = Str::uuid();
            $location = $request->location_id;
            $category = $request->categories_id;
            $year = \Carbon\Carbon::parse($request->accuisition_date)->format('y');
            $custom = $location.'-'.$category.'-'.$year;
            $method = $request->method;

            $accuisitionCost = $request->accuisition_cost;
            $residualValue = $accuisitionCost * 0.1;
            $usagePeriod = $request->usage_period;

            // Tetapkan nilai persentase penyusutan berdasarkan metode
            if ($method == 'STRAIGHT_LINE') {
                $depreciationRate = 0.05; // 5% untuk Straight Line
            } else if ($method == 'REDUCING_BALANCE') {
                $depreciationRate = 0.10; // 10% untuk Reducing Balance
            } else {
                $depreciationRate = 0.05; // Default
            }

            // Hitung nilai penyusutan per tahun
            if ($request->has('usage_value_per_year') && $request->usage_value_per_year > 0) {
                $usageValuePerYear = $request->usage_value_per_year;
            } else {
                if ($method == 'STRAIGHT_LINE') {
                    $usageValuePerYear = $this->calculateStraightLineDepreciationWithRate($accuisitionCost, $depreciationRate);
                } else if ($method == 'REDUCING_BALANCE') {
                    $usageValuePerYear = $this->calculateReducingBalanceDepreciationWithRate($accuisitionCost, $depreciationRate);
                } else {
                    $usageValuePerYear = 0;
                }
            }

            if ($request->has('accumulation_depreciation_value') && $request->accumulation_depreciation_value > 0) {
                $accumulationDepreciationValue = $request->accumulation_depreciation_value;
            } else {
                // Gunakan periode penggunaan sebagai jumlah tahun
                $years = $usagePeriod;
                
                if ($method == 'STRAIGHT_LINE') {
                    $accumulationDepreciationValue = $this->calculateAccumulatedStraightLineDepreciationWithRate($accuisitionCost, $depreciationRate, $years);
                } else if ($method == 'REDUCING_BALANCE') {
                    $accumulationDepreciationValue = $this->calculateAccumulatedReducingBalanceDepreciationWithRate($accuisitionCost, $depreciationRate, $years);
                } else {
                    $accumulationDepreciationValue = 0;
                }
            }

            if ($nonDepreciation == 0) {
                if ($method == 'STRAIGHT_LINE') {
                    $assets = Assets::create([
                        'uuid' => $uuid,
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $accuisitionCost,
                        'method' => Method::STRAIGHT_LINE,
                        'usage_period' => $usagePeriod,
                        'usage_value_per_year' => $usageValuePerYear,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $accumulationDepreciationValue,
                        'depreciation_date' => $request->depreciation_date,
                        'depreciation_rate' => $depreciationRate,
                        'created_by_id' => Auth::user()->id,
                    ]);
                } elseif ($method == 'REDUCING_BALANCE') {
                    $assets = Assets::create([
                        'uuid' => $uuid,
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $accuisitionCost,
                        'method' => Method::REDUCING_BALANCE,
                        'usage_period' => $usagePeriod,
                        'usage_value_per_year' => $usageValuePerYear,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $accumulationDepreciationValue,
                        'depreciation_date' => $request->depreciation_date,
                        'depreciation_rate' => $depreciationRate,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            } else {
                $assets = Assets::create([
                    'uuid' => $uuid,
                    'name' => $request->name,
                    'location_id' => $request->location_id,
                    'categories_id' => $request->categories_id,
                    'account_fixed_asset' => $request->account_fixed_asset,
                    'description' => $request->description,
                    'custom_number' => $custom,
                    'non_depreciation' => 1,
                    'accuisition_date' => $request->accuisition_date,
                    'accuisition_cost' => $accuisitionCost,
                    'depreciation_rate' => $depreciationRate,
                    'created_by_id' => Auth::user()->id,
                ]);
            }

            $transactionNumber = 'TRX-' . date('YmdHis') . '-' . substr($uuid, 0, 8);

            AssetHistory::create([
                'asset_uuid' => $uuid,
                'action' => 'created',
                'transaction_number' => $transactionNumber,
                'account' => $request->account_fixed_asset,
                'debit' => $request->accuisition_cost,
                'credit' => 0,
                'created_by_id' => Auth::user()->id,
            ]);

            return redirect()->route('getIndex')->with('success', 'Item Added successfully.');
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }


    /**
     * Display the specified resource.
     * @param  \App\Models\SagaraController  $sagaraController
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $sagaraController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getEdit(string $uuid)
    {
        //
        $assets = Assets::where('uuid', $uuid)->first();
        $locations = Locations::all();
        $categories = Categories::all();
        return view('dashboard.section.edit.index', compact('assets', 'locations', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SarungController  $sagaraController
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, string $uuid)
    {
        try {
            //code...
            $assets = Assets::where('uuid', $uuid)->first();
            $request->validate([
                'name' => 'required|string',
                'location_id' => 'required|exists:locations,id',
                'categories_id' => 'required|exists:categories,id',
                'account_fixed_asset' => 'nullable|string',
                'description' => 'required|string',
                'accuisition_date' => 'nullable|date',
                'accuisition_cost' => 'nullable|integer',
                'usage_period' => 'nullable|integer',
                'usage_value_per_year' => 'nullable|integer',
                'depreciation_account' => 'nullable|string',
                'accumulation_depreciation_account' => 'nullable|string',
                'accumulation_depreciation_value' => 'nullable|integer',
                'depreciation_date' => 'nullable|date',
            ]);

            // Hitung periode penggunaan dari tanggal akuisisi dan tanggal penyusutan
            if ($request->has('accuisition_date') && $request->has('depreciation_date') && !$request->filled('usage_period')) {
                $acquisitionDate = \Carbon\Carbon::parse($request->accuisition_date);
                $depreciationDate = \Carbon\Carbon::parse($request->depreciation_date);
                
                // Hitung selisih dalam tahun
                $usagePeriod = $depreciationDate->diffInYears($acquisitionDate);
                
                // Update nilai usage_period
                $request->merge(['usage_period' => $usagePeriod]);
            }

            // Hitung tanggal penyusutan dari tanggal akuisisi dan periode penggunaan
            if ($request->has('accuisition_date') && $request->has('usage_period') && !$request->filled('depreciation_date')) {
                $acquisitionDate = \Carbon\Carbon::parse($request->accuisition_date);
                
                // Tambahkan periode penggunaan dalam tahun
                $depreciationDate = $acquisitionDate->copy()->addYears($request->usage_period);
                
                // Update nilai depreciation_date
                $request->merge(['depreciation_date' => $depreciationDate->format('Y-m-d')]);
            }

            // Create a new Sagara instance
            $location = $request->location_id;
            $category = $request->categories_id;
            $year = \Carbon\Carbon::parse($request->accuisition_date)->format('y');
            $custom = $location.'-'.$category.'-'.$year;
            $method = $request->method;

            $accuisitionCost = $request->accuisition_cost;
            $residualValue = $accuisitionCost * 0.1;
            $usagePeriod = $request->usage_period;

            // Tetapkan nilai persentase penyusutan berdasarkan metode
            if ($method == 'STRAIGHT_LINE') {
                $depreciationRate = 0.05; // 5% untuk Straight Line
            } else if ($method == 'REDUCING_BALANCE') {
                $depreciationRate = 0.10; // 10% untuk Reducing Balance
            } else {
                $depreciationRate = 0.05; // Default
            }

            // Hitung nilai penyusutan per tahun
            if ($request->has('usage_value_per_year') && $request->usage_value_per_year > 0) {
                $usageValuePerYear = $request->usage_value_per_year;
            } else {
                if ($method == 'STRAIGHT_LINE') {
                    $usageValuePerYear = $this->calculateStraightLineDepreciationWithRate($accuisitionCost, $depreciationRate);
                } else if ($method == 'REDUCING_BALANCE') {
                    $usageValuePerYear = $this->calculateReducingBalanceDepreciationWithRate($accuisitionCost, $depreciationRate);
                } else {
                    $usageValuePerYear = 0;
                }
            }

            if ($request->has('accumulation_depreciation_value') && $request->accumulation_depreciation_value > 0) {
                $accumulationDepreciationValue = $request->accumulation_depreciation_value;
            } else {
                // Gunakan periode penggunaan sebagai jumlah tahun
                $years = $usagePeriod;
                
                if ($method == 'STRAIGHT_LINE') {
                    $accumulationDepreciationValue = $this->calculateAccumulatedStraightLineDepreciationWithRate($accuisitionCost, $depreciationRate, $years);
                } else if ($method == 'REDUCING_BALANCE') {
                    $accumulationDepreciationValue = $this->calculateAccumulatedReducingBalanceDepreciationWithRate($accuisitionCost, $depreciationRate, $years);
                } else {
                    $accumulationDepreciationValue = 0;
                }
            }

            if ($request->non_depreciation == null) {
                if ($method == 'STRAIGHT_LINE') {
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $accuisitionCost,
                        'method' => Method::STRAIGHT_LINE,
                        'usage_period' => $usagePeriod,
                        'usage_value_per_year' => $usageValuePerYear,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $accumulationDepreciationValue,
                        'depreciation_date' => $request->depreciation_date,
                        'depreciation_rate' => $depreciationRate,
                        'created_by_id' => Auth::user()->id,
                    ]);
                } elseif ($method == 'REDUCING_BALANCE') {
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $accuisitionCost,
                        'method' => Method::REDUCING_BALANCE,
                        'usage_period' => $usagePeriod,
                        'usage_value_per_year' => $usageValuePerYear,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $accumulationDepreciationValue,
                        'depreciation_date' => $request->depreciation_date,
                        'depreciation_rate' => $depreciationRate,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            } else {
                $assets->update([
                    'name' => $request->name,
                    'location_id' => $request->location_id,
                    'categories_id' => $request->categories_id,
                    'account_fixed_asset' => $request->account_fixed_asset,
                    'description' => $request->description,
                    'custom_number' => $custom,
                    'non_depreciation' => 1,
                    'accuisition_date' => $request->accuisition_date,
                    'accuisition_cost' => $accuisitionCost,
                    'depreciation_rate' => $depreciationRate,
                    'created_by_id' => Auth::user()->id,
                ]);
            }

            $transactionNumber = 'TRX-' . date('YmdHis') . '-' . substr($assets->uuid, 0, 8);

            AssetHistory::create([
                'asset_uuid' => $assets->uuid,
                'action' => 'updated',
                'transaction_number' => $transactionNumber,
                'account' => $request->account_fixed_asset,
                'debit' => $request->accuisition_cost - $assets->getOriginal('accuisition_cost'), // Selisih nilai jika ada kenaikan
                'credit' => $assets->getOriginal('accuisition_cost') - $request->accuisition_cost, // Selisih nilai jika ada penurunan
                'created_by_id' => Auth::user()->id,
            ]);

            return redirect()->route('getIndex')->with('success', 'Item Added successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "error" => $th->getMessage(),
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid)
    {
        try {
            $asset = Assets::where('uuid', $uuid)->first();

            if (!$asset) {
                return redirect()->route('getIndex')->with('error', 'Asset tidak ditemukan');
            }

            $transactionNumber = 'TRX-' . date('YmdHis') . '-' . substr($uuid, 0, 8);

            AssetHistory::create([
                'asset_uuid' => $asset->uuid,
                'action' => 'deleted',
                'transaction_number' => $transactionNumber,
                'account' => $asset->account_fixed_asset,
                'debit' => 0,
                'credit' => $asset->accuisition_cost,
                'created_by_id' => Auth::user()->id,
            ]);

            $asset->delete();

            return redirect()->route('getIndex')->with('success', 'Aset berhasil dihapus dan dipindahkan ke history');
        } catch (\Throwable $th) {
            return response()->json([
                "error" => $th->getMessage(),
            ]);
        }
    }

    public function create()
    {
        $categories = Categories::all();
        $locations = Locations::all();
        return view('dashboard.section.create.index', compact(['categories', 'locations']));
    }

    public function getLocations()
    {
        return view('dashboard.section.settings.createLocations.index');

    }

    public function createLocations (Request $request)
    {
        try {
            //code...
            $request->validate([
                'name' => 'required|string',
            ]);

            $locations = Locations::create([
                'name' => $request->name,
                'created_by_id' => Auth::user()->id,
            ]);
            return redirect()->route('settings')->with('Success','Item Add Successfully');
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                "error"=>$th->getMessage(),
            ]);
        }
    }

    public function getCategories()
    {
        return view('dashboard.section.settings.createCategories.index');

    }

    public function createCategories (Request $request)
    {
        try {
            //code...
            $request->validate([
                'name' => 'required|string',
            ]);

            $categories = Categories::create([
                'name' => $request->name,
                'created_by_id' => Auth::user()->id,
            ]);
            return redirect()->route('settings')->with('Success','Item Add Successfully');
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                "error"=>$th->getMessage(),
            ]);
        }
    }

    /**
     * Menghitung penyusutan dengan metode Straight Line
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $residualValue Nilai sisa aset
     * @param int $usagePeriod Masa manfaat aset (dalam tahun)
     * @return float Nilai penyusutan per tahun
     */
    private function calculateStraightLineDepreciation($acquisitionCost, $residualValue, $usagePeriod)
    {
        // Rumus: (Harga Perolehan - Nilai Sisa) / Masa Manfaat
        $depreciableAmount = $acquisitionCost - $residualValue;
        $annualDepreciation = $depreciableAmount / $usagePeriod;

        return $annualDepreciation;
    }

    /**
     * Menghitung penyusutan dengan metode Reducing Balance
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $residualValue Nilai sisa aset
     * @param int $usagePeriod Masa manfaat aset (dalam tahun)
     * @param float $currentYear Tahun ke berapa (1, 2, 3, dst)
     * @return float Nilai penyusutan untuk tahun tersebut
     */
    private function calculateReducingBalanceDepreciation($acquisitionCost, $residualValue, $usagePeriod, $currentYear = 1)
    {
        // Menghitung persentase penyusutan
        // Rumus: 1 - pangkat(Nilai Sisa / Harga Perolehan, 1/Masa Manfaat)
        $rate = 1 - pow(($residualValue / $acquisitionCost), (1 / $usagePeriod));
        $rate = round($rate * 100) / 100; // Pembulatan ke 2 desimal

        // Menghitung nilai buku di awal tahun
        $bookValue = $acquisitionCost;
        for ($i = 1; $i < $currentYear; $i++) {
            $depreciation = $bookValue * $rate;
            $bookValue -= $depreciation;

            // Pastikan nilai buku tidak kurang dari nilai sisa
            if ($bookValue <= $residualValue) {
                $bookValue = $residualValue;
                break;
            }
        }

        // Hitung penyusutan untuk tahun yang diminta
        $depreciation = $bookValue * $rate;

        // Pastikan nilai buku setelah penyusutan tidak kurang dari nilai sisa
        if (($bookValue - $depreciation) < $residualValue) {
            $depreciation = $bookValue - $residualValue;
        }

        return $depreciation;
    }

    /**
     * Menghitung akumulasi penyusutan dengan metode Straight Line
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $residualValue Nilai sisa aset
     * @param int $usagePeriod Masa manfaat aset (dalam tahun)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai akumulasi penyusutan
     */
    private function calculateAccumulatedStraightLineDepreciation($acquisitionCost, $residualValue, $usagePeriod, $years)
    {
        $annualDepreciation = $this->calculateStraightLineDepreciation($acquisitionCost, $residualValue, $usagePeriod);
        $accumulatedDepreciation = $annualDepreciation * $years;

        // Pastikan akumulasi penyusutan tidak melebihi jumlah yang dapat disusutkan
        $depreciableAmount = $acquisitionCost - $residualValue;
        if ($accumulatedDepreciation > $depreciableAmount) {
            $accumulatedDepreciation = $depreciableAmount;
        }

        return $accumulatedDepreciation;
    }

    /**
     * Menghitung akumulasi penyusutan dengan metode Reducing Balance
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $residualValue Nilai sisa aset
     * @param int $usagePeriod Masa manfaat aset (dalam tahun)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai akumulasi penyusutan
     */
    private function calculateAccumulatedReducingBalanceDepreciation($acquisitionCost, $residualValue, $usagePeriod, $years)
    {
        $rate = 1 - pow(($residualValue / $acquisitionCost), (1 / $usagePeriod));
        $rate = round($rate * 100) / 100; // Pembulatan ke 2 desimal

        $bookValue = $acquisitionCost;
        $accumulatedDepreciation = 0;

        for ($i = 1; $i <= $years; $i++) {
            $depreciation = $bookValue * $rate;

            // Pastikan nilai buku tidak kurang dari nilai sisa
            if (($bookValue - $depreciation) < $residualValue) {
                $depreciation = $bookValue - $residualValue;
                $accumulatedDepreciation += $depreciation;
                break;
            }

            $accumulatedDepreciation += $depreciation;
            $bookValue -= $depreciation;
        }

        return $accumulatedDepreciation;
    }

    /**
     * Display the asset history.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHistory()
    {
        $histories = AssetHistory::with('asset')->orderBy('created_at', 'desc')->get();
        return view('dashboard.section.history.index', compact('histories'));
    }

    /**
     * Restore the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function restore(string $uuid)
    {
        try {
            // Temukan aset yang telah dihapus
            $asset = Assets::withTrashed()->where('uuid', $uuid)->first();

            if (!$asset) {
                return redirect()->route('history')->with('error', 'Aset tidak ditemukan');
            }

            // Buat nomor transaksi unik
            $transactionNumber = 'TRX-' . date('YmdHis') . '-' . substr($uuid, 0, 8);

            // Restore aset
            $asset->restore();

            // Simpan ke dalam history
            AssetHistory::create([
                'asset_uuid' => $asset->uuid,
                'action' => 'restored',
                'transaction_number' => $transactionNumber,
                'account' => $asset->account_fixed_asset,
                'debit' => $asset->accuisition_cost, // Debit sebesar nilai aset
                'credit' => 0, // Tidak ada kredit pada restore
                'created_by_id' => Auth::user()->id,
            ]);

            return redirect()->route('history')->with('success', 'Aset berhasil dipulihkan');
        } catch (\Throwable $th) {
            return redirect()->route('history')->with('error', 'Gagal memulihkan aset: ' . $th->getMessage());
        }
    }

    /**
     * Delete history record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteHistory($id)
    {
        try {
            // Temukan history berdasarkan ID
            $history = AssetHistory::findOrFail($id);

            // Hapus history
            $history->delete();

            return redirect()->route('history')->with('success', 'Riwayat berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('history')->with('error', 'Gagal menghapus riwayat: ' . $th->getMessage());
        }
    }

    /**
     * Menghitung penyusutan dengan metode Straight Line dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $currentYear Tahun ke berapa (1, 2, 3, dst)
     * @return float Nilai penyusutan untuk tahun tersebut
     */
    private function calculateStraightLineDepreciationWithRate($acquisitionCost, $depreciationRate, $currentYear = 1)
    {
        // Rumus: Harga Perolehan * Persentase Penyusutan
        $annualDepreciation = $acquisitionCost * $depreciationRate;
        
        return $annualDepreciation;
    }

    /**
     * Menghitung nilai buku dengan metode Straight Line dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai buku setelah penyusutan
     */
    private function calculateStraightLineBookValueWithRate($acquisitionCost, $depreciationRate, $years)
    {
        // Rumus: Harga Perolehan - (Harga Perolehan * Persentase Penyusutan * Tahun)
        $totalDepreciation = $acquisitionCost * $depreciationRate * $years;
        $bookValue = $acquisitionCost - $totalDepreciation;
        
        // Pastikan nilai buku tidak negatif
        return max(0, $bookValue);
    }

    /**
     * Menghitung akumulasi penyusutan dengan metode Straight Line dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai akumulasi penyusutan
     */
    private function calculateAccumulatedStraightLineDepreciationWithRate($acquisitionCost, $depreciationRate, $years)
    {
        // Rumus: Harga Perolehan * Persentase Penyusutan * Tahun
        $accumulatedDepreciation = $acquisitionCost * $depreciationRate * $years;
        
        // Pastikan akumulasi penyusutan tidak melebihi harga perolehan
        return min($acquisitionCost, $accumulatedDepreciation);
    }

    /**
     * Menghitung penyusutan dengan metode Reducing Balance dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $currentYear Tahun ke berapa (1, 2, 3, dst)
     * @return float Nilai penyusutan untuk tahun tersebut
     */
    private function calculateReducingBalanceDepreciationWithRate($acquisitionCost, $depreciationRate, $currentYear = 1)
    {
        // Menghitung nilai buku di awal tahun
        $bookValue = $acquisitionCost;
        
        for ($i = 1; $i < $currentYear; $i++) {
            $depreciation = $bookValue * $depreciationRate;
            $bookValue -= $depreciation;
        }
        
        // Hitung penyusutan untuk tahun yang diminta
        $depreciation = $bookValue * $depreciationRate;
        
        return $depreciation;
    }

    /**
     * Menghitung nilai buku dengan metode Reducing Balance dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai buku setelah penyusutan
     */
    private function calculateReducingBalanceBookValueWithRate($acquisitionCost, $depreciationRate, $years)
    {
        $bookValue = $acquisitionCost;
        
        for ($i = 1; $i <= $years; $i++) {
            $depreciation = $bookValue * $depreciationRate;
            $bookValue -= $depreciation;
        }
        
        // Pastikan nilai buku tidak negatif
        return max(0, $bookValue);
    }

    /**
     * Menghitung akumulasi penyusutan dengan metode Reducing Balance dengan persentase tetap
     *
     * @param float $acquisitionCost Harga perolehan aset
     * @param float $depreciationRate Persentase penyusutan (misal: 0.05 untuk 5%)
     * @param int $years Jumlah tahun yang telah berlalu
     * @return float Nilai akumulasi penyusutan
     */
    private function calculateAccumulatedReducingBalanceDepreciationWithRate($acquisitionCost, $depreciationRate, $years)
    {
        $bookValue = $acquisitionCost;
        $accumulatedDepreciation = 0;
        
        for ($i = 1; $i <= $years; $i++) {
            $depreciation = $bookValue * $depreciationRate;
            $bookValue -= $depreciation;
            $accumulatedDepreciation += $depreciation;
        }
        
        return $accumulatedDepreciation;
    }
}
