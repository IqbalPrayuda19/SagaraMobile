<?php

namespace App\Http\Controllers;

use App\Models\Sagara;
use Illuminate\Http\Request;

class SagaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        //
        $data['sagara_mobile']=Sagara::all();
        return view ('dashboard.section.dashboard.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response

     */
    public function create()
    {
        //
        return view('dashboard.section.create.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([

        ]);
        $input = $request->all();

        Sagara::create($input);

        return redirect()->route('halaman.getIndex')->with('success','Item Added successfully.');
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\SagaraController  $sarungController
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
