<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
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
    Route::post('/payment',[PaymentController::class,'store'])->name('store_payment.api'); // Save Payment
    Route::get('/payment',[PaymentController::class,'index'])->name('index_payment.api'); // Show All Payments
    Route::get('/payment/{id}', [PaymentController::class,'show'])->name('show_payment.api'); // Show Single Payment
    Route::delete('/payment/{id}', [PaymentController::class,'destroy'])->name('destroy_payment.api'); // Delete Single Payment
    Route::put('/payment/{id}', [PaymentController::class,'update'])->name('update_payment.api'); // Edit Single Payment


    // Expense Routes --> Outgoing Expenses
    Route::post('/expense',[ExpenseController::class,'store'])->name('store_expense.api'); // Save Expense
    Route::get('/expense',[ExpenseController::class,'index'])->name('index_expense.api'); // Show All Expenses
    Route::get('/expense/{id}', [ExpenseController::class,'show'])->name('show_expense.api'); // Show Single Expense
    Route::delete('/expense/{id}', [ExpenseController::class,'destroy'])->name('destroy_expense.api'); // Delete Single Expense
    Route::put('/expense/{id}', [ExpenseController::class,'update'])->name('update_expense.api'); // Edit Single Expense


});
