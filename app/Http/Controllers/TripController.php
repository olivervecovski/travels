<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Trip::latest()->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsTrip $modelsTrip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsTrip $modelsTrip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsTrip $modelsTrip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsTrip $modelsTrip)
    {
        //
    }
}
