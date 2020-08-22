<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

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
        // Get public trips(only) orderded by start date
        $trips = Trip::latest()->where('private', false)->orderBy('start_date', 'desc')->get();
        return response(TripResource::collection($trips), 200);
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
        return $this->tripResponse($trip, "New trip successfully created", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        $user = Auth::guard('api')->user();

        if($trip->private) {
            if(!$user || $user->id != $trip->user_id){
                return response()->json([
                    'success' => false,
                    'message' => "Only the owner of this trip have permission to view it"
                ], 403);
            }
        }

        return response()->json([
            'success' => true,
            'trip' => new TripResource($trip)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        try {
            $this->authorize('update', $trip);
        }
        catch(Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to update this trip"
            ], 403);
        }

        $trip->update($request->all());
        return $this->tripResponse($trip, "Successfully updated trip", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsTrip  $modelsTrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        try {
            $this->authorize('delete', $trip);
        }
        catch(Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to delete this trip"
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => "Trip was successfully deleted"
        ], 200);
        
    }

    public function trips() {
        $trips = auth()->user()->trips;
        return response()->json([
            'count' => count($trips),
            'trips' => TripResource::collection($trips)
        ]);
    }

    private function tripResponse(Trip $trip, $message, $status_code) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'trip' => new TripResource($trip)
        ], $status_code);
    }
}
