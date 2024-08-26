<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Enums\Method;
use Illuminate\Http\Request;

class SagaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        //
        $data = Assets::all();
        return view ('dashboard.section.dashboard.index',$data);
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
        // Validate the request data
        $request->validate([
            'uuid' => 'required|uuid',
            'name' => 'required|string',
            'locations_id' => 'required|exists:locations,id',
            'categories_id' => 'required|exists:categories,id',
            'custom_number' => 'nullable|string',
            'account_fixed_asset' => 'nullable|string',
            'description' => 'nullable|string',
            'accuisition_date' => 'required|date',
            'accuisition_cost' => 'required|integer',
            'method' => 'required|in:' . implode(',', Method::values()),
            'usage_period' => 'nullable|integer',
            'usage_value_per_year' => 'nullable|integer',
            'depreciation_account' => 'nullable|string',
            'accumulation_depreciation_account' => 'nullable|string',
            'accumulation_depreciation_value' => 'nullable|integer',
            'depreciation_date' => 'nullable|date',
            'created_by_id' => 'required|exists:users,id',
        ]);

        // Create a new Sagara instance
        $sagara_mobile = Assets::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('dashboard.section.create.getIndex')->with('success', 'Item Added successfully.');
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
    public function getEdit(string $id)
    {
        //
        $sagara_mobile = Assets::find($id);
        return view('', compact('sagara_mobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SarungController  $sagaraController
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, string $id)
    {
        $sagara_mobile = Assets::find($id);
        $sagara_mobile->name = $request->input('name');
        $sagara_mobile->locations_id = $request->input('locations_id');
        $sagara_mobile->categories_id = $request->input('categories_id');
        $sagara_mobile->custom_number = $request->input('custom_number');
        $sagara_mobile->account_fixed_asset = $request->input('account_fixed_asset');
        $sagara_mobile->description = $request->input('description');
        $sagara_mobile->accuisition_date = $request->input('accuisition_date');
        $sagara_mobile->accuisition_cost = $request->input('accuisition_cost');
        $sagara_mobile->method = $request->input('method');
        $sagara_mobile->usage_period = $request->input('usage_period');
        $sagara_mobile->usage_value_per_year = $request->input('usage_value_per_year');
        $sagara_mobile->depreciation_account = $request->input('depreciation_account');
        $sagara_mobile->accumulation_depreciation_account = $request->input('accumulation_depreciation_account');
        $sagara_mobile->accumulation_depreciation_value = $request->input('accumulation_depreciation_value');
        $sagara_mobile->depreciation_date = $request->input('depreciation_date');
        $sagara_mobile->created_by_id = $request->input('created_by_id');

        $input = $request->all();

        $sagara_mobile->update($input);

        return redirect()->route('dashboard.section.create.getIndex')->with('success', 'Item Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SarungController  $sagaraController
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        //
        $sagara_mobile = Assets::find($id);
        $sagara_mobile->delete();
        return redirect()->route('dashboard.section.create.getIndex')->with('Success','Item Deleted Successfully');
    }
}
