<?php

namespace App\Http\Controllers;


use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $residents = Resident::all()->toArray();

        return array_reverse($residents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Request to add apartment');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'phone' => 'string|max:12',
            'apartment_id' => 'required|numeric|max:150'
        ]);
        if ($validator->fails())
        {
            Log::error('Validation failed',[$validator->errors()->all()]);
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $resident = Resident::create($request->toArray());
        $response = ['data' => $resident,'message' => 'Successfully Saved Resident!'];
        Log::info('Saved new instance of Resident:', [$response['data']]);
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident)
    {
        //
    }
}
