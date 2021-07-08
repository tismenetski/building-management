<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all()->toArray();
        Log::info('Request to get all Expenses');

        $response = ['data' => $expenses,'message' => 'Successfully Got Expenses!'];
        Log::info('Returning Expenses:', [$response['data']]);
        return response($response, 200);
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        Log::info('Request to add expense');
        $validator = Validator::make($request->all(), [
            'expense_name' => 'required|string|max:255',
            'expense_for' => 'required|string|max:255',
            'paid_at' => 'required|date_format:Y-m-d',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|numeric|between:0,10000',
            'expense_notes' => 'string|max:1000',
        ]);
        if ($validator->fails())
        {
            Log::error('Validation failed',[$validator->errors()->all()]);
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $expense = Expense::create($request->toArray());
        $response = ['data' => $expense,'message' => 'Successfully Saved Expense!'];
        Log::info('Saved new instance of Expense:', [$response['data']]);
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $payment = Expense::find($id);
        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->update($request->all());

        return response()->json(['data' =>$expense,'message' => 'Expense Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::destroy($id);
        $response = ['message' => 'Successfully Deleted Expense!'];
        return response($response, 204);
    }
}
