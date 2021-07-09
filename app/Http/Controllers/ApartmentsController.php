<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all()->toArray();
        Log::info('Request to get all Expenses');

        $response = ['data' => $apartments,'message' => 'Successfully Got Apartments!'];
        Log::info('Returning Apartments:', [$response['data']]);
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $apartments = Apartment::all()->toArray();

        return array_reverse($apartments);
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
            'number' => 'required|numeric|max:150',
            'level' => 'required|numeric|max:100'
        ]);
        if ($validator->fails())
        {
            Log::error('Validation failed',[$validator->errors()->all()]);
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $apartment = Apartment::create($request->toArray());
        $response = ['data' => $apartment,'message' => 'Successfully Saved Apartment!'];
        Log::info('Saved new instance of Apartment:', [$response['data']]);
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);
        $residents = $apartment->residents;
        return response(['apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
