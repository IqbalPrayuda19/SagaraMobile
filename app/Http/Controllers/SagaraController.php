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

class SagaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        //
        $assets = Assets::all();
        // dd ($assets);
        return view ('dashboard.section.assets.index', compact('assets'));
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
        // dd($request);
        // Validate the request data
        try {
            //code...
            $request->validate([
                'name' => 'required|string',
                'location_id' => 'required|exists:locations,id',
                'categories_id' => 'required|exists:categories,id',
                'account_fixed_asset' => 'nullable|string',
                'description' => 'required|string',
                'accuisition_date' => 'nullable|date',
                'accuisition_cost' => 'nullable|integer',
                // 'method' => ['nullable', Rule::in(array_column(Method::cases(), 'value'))],
                'usage_period' => 'nullable|integer',
                'usage_value_per_year' => 'nullable|integer',
                'depreciation_account' => 'nullable|string',
                'accumulation_depreciation_account' => 'nullable|string',
                'accumulation_depreciation_value' => 'nullable|integer',
                'depreciation_date' => 'nullable|date',
            ]);

            // Create a new Sagara instance
            $uuid = Str::uuid();
            $location = $request->location_id;
            $category = $request->categories_id;
            $year = \Carbon\Carbon::parse( $request->accuisition_date )->format('y');
            $custom = $location.'-'.$category.'-'.$year;
            $method = $request->method;
            if ($request->non_depreciation == null){
                if($method == 'STRAIGHT_LINE'){
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
                        'accuisition_cost' => $request->accuisition_cost,
                        'method' => Method::STRAIGHT_LINE,
                        'usage_period' => $request->usage_period,
                        'usage_value_per_year' => $request->usage_value_per_year,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $request->accumulation_depreciation_value,
                        'depreciation_date' => $request->depreciation_date,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
                elseif ($method == 'REDUCING_BALANCE'){
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
                        'accuisition_cost' => $request->accuisition_cost,
                        'method' => Method::REDUCING_BALANCE,
                        'usage_period' => $request->usage_period,
                        'usage_value_per_year' => $request->usage_value_per_year,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $request->accumulation_depreciation_value,
                        'depreciation_date' => $request->depreciation_date,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            }
            else{
                if($method == 'STRAIGHT_LINE'){
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
                        'accuisition_cost' => $request->accuisition_cost,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
                elseif ($method == 'REDUCING_BALANCE'){
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
                        'accuisition_cost' => $request->accuisition_cost,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            }

            // Redirect to the index page with a success message
            return redirect()->route('getIndex')->with('success', 'Item Added successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "error"=>$th->getMessage(),
            ]);
        };
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
                // 'method' => ['nullable', Rule::in(array_column(Method::cases(), 'value'))],
                'usage_period' => 'nullable|integer',
                'usage_value_per_year' => 'nullable|integer',
                'depreciation_account' => 'nullable|string',
                'accumulation_depreciation_account' => 'nullable|string',
                'accumulation_depreciation_value' => 'nullable|integer',
                'depreciation_date' => 'nullable|date',
            ]);

            // Create a new Sagara instance
            $location = $request->location_id;
            $category = $request->categories_id;
            $year = \Carbon\Carbon::parse( $request->accuisition_date )->format('y');
            $custom = $location.'-'.$category.'-'.$year;
            $method = $request->method;
            if ($request->non_depreciation == null){
                if($method == 'STRAIGHT_LINE'){
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $request->accuisition_cost,
                        'method' => Method::STRAIGHT_LINE,
                        'usage_period' => $request->usage_period,
                        'usage_value_per_year' => $request->usage_value_per_year,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $request->accumulation_depreciation_value,
                        'depreciation_date' => $request->depreciation_date,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
                elseif ($method == 'REDUCING_BALANCE'){
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 0,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $request->accuisition_cost,
                        'method' => Method::REDUCING_BALANCE,
                        'usage_period' => $request->usage_period,
                        'usage_value_per_year' => $request->usage_value_per_year,
                        'depreciation_account' => $request->depreciation_account,
                        'accumulation_depreciation_account' => $request->accumulation_depreciation_account,
                        'accumulation_depreciation_value' => $request->accumulation_depreciation_value,
                        'depreciation_date' => $request->depreciation_date,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            }
            else{
                if($method == 'STRAIGHT_LINE'){
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 1,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $request->accuisition_cost,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
                elseif ($method == 'REDUCING_BALANCE'){
                    $assets->update([
                        'name' => $request->name,
                        'location_id' => $request->location_id,
                        'categories_id' => $request->categories_id,
                        'account_fixed_asset' => $request->account_fixed_asset,
                        'description' => $request->description,
                        'custom_number' => $custom,
                        'non_depreciation' => 1,
                        'accuisition_date' => $request->accuisition_date,
                        'accuisition_cost' => $request->accuisition_cost,
                        'created_by_id' => Auth::user()->id,
                    ]);
                }
            }

            // Redirect to the index page with a success message
            return redirect()->route('getIndex')->with('success', 'Item Added successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "error"=>$th->getMessage(),
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SarungController  $sagaraController
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid)
    {
        //
        try {
            //code...
            $assets = Assets::where('uuid', $uuid);
            // dd($assets);
            $assets->delete();
            return redirect()->route('getIndex')->with('Success','Item Deleted Successfully');
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                "error"=>$th->getMessage(),
            ]);
        }
    }

    public function create()
    {
        $categories = Categories::all();
        $locations = Locations::all();
        return view('dashboard.section.create.index', compact(['categories', 'locations']));
    }
}
