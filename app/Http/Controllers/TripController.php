<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $trip = Auth::user()->trips()->create($request->all());
        return $this->tripResponse($trip);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return response()->json([
            'trip' => new TripResource($trip)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function trips() {
        $trips = auth()->user()->trips;
        return response()->json([
            'count' => count($trips),
            'trips' => TripResource::collection($trips)
        ]);
    }

    private function tripResponse(Trip $trip) {
        return response()->json([
            'success' => true,
            'message' => 'New trip successfully created',
            'trip' => new TripResource($trip)
        ]);
    }
}
