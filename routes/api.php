<?php

use App\Http\Controllers\ApartmentsController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ResidentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // ...

    Route::post('/login', [ApiAuthController::class,'login'])->name('login.api');
    Route::post('/register',[ApiAuthController::class,'register'])->name('register.api');
//    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');


    // Payment Routes --> Incoming Payments
    Route::post('/payment',[PaymentsController::class,'store'])->name('store_payment.api'); // Save Payment
    Route::get('/payment',[PaymentsController::class,'index'])->name('index_payment.api'); // Show All Payments
    Route::get('/payment/{id}', [PaymentsController::class,'show'])->name('show_payment.api'); // Show Single Payment
    Route::delete('/payment/{id}', [PaymentsController::class,'destroy'])->name('destroy_payment.api'); // Delete Single Payment
    Route::put('/payment/{id}', [PaymentsController::class,'update'])->name('update_payment.api'); // Edit Single Payment


    // Expense Routes --> Outgoing Expenses
    Route::post('/expense',[ExpensesController::class,'store'])->name('store_expense.api'); // Save Expense
    Route::get('/expense',[ExpensesController::class,'index'])->name('index_expense.api'); // Show All Expenses
    Route::get('/expense/{id}', [ExpensesController::class,'show'])->name('show_expense.api'); // Show Single Expense
    Route::delete('/expense/{id}', [ExpensesController::class,'destroy'])->name('destroy_expense.api'); // Delete Single Expense
    Route::put('/expense/{id}', [ExpensesController::class,'update'])->name('update_expense.api'); // Edit Single Expense


    // Apartment Routes
    Route::post('/apartment',[ApartmentsController::class,'store'])->name('store_apartment.api'); // Save Apartment
    Route::get('/apartment',[ApartmentsController::class,'index'])->name('index_apartment.api'); // Get All Apartments
    Route::get('/apartment/{id}', [ApartmentsController::class,'show'])->name('show_apartment.api'); // Show Single Apartment
    Route::delete('/apartment/{id}', [ApartmentsController::class,'destroy'])->name('destroy_apartment.api'); // Delete Single Apartment
    Route::put('/apartment/{id}', [ApartmentsController::class,'update'])->name('update_apartment.api'); // Edit Single Apartment


    // Resident Routes
    Route::post('/resident',[ResidentsController::class,'store'])->name('store_resident.api'); // Save Resident
    Route::get('/resident',[ResidentsController::class,'index'])->name('index_resident.api'); // Get All Residents
    Route::get('/resident/{id}', [ResidentsController::class,'show'])->name('show_resident.api'); // Show Single Resident
    Route::delete('/resident/{id}', [ResidentsController::class,'destroy'])->name('destroy_resident.api'); // Delete Single Resident
    Route::put('/resident/{id}', [ResidentsController::class,'update'])->name('update_resident.api'); // Edit Single Resident
});
