<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProblemSolvingController;
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


Route::post('/lowest-integer', [ProblemSolvingController::class, 'getLowestIntegerPositiveValue']);
Route::get('/get-numbers-without-five', [ProblemSolvingController::class, 'getNumbersWithoutFive']);
Route::get('/get-alphabetic-index', [ProblemSolvingController::class, 'getAlphabeticIndex']);
Route::get('/get-min-steps', [ProblemSolvingController::class, 'getMinSteps']);
Route::post('/create-order', [OrdersController::class, 'createOrder']);
Route::get('/get-orders', [OrdersController::class, 'getOrders']);
Route::get('/get-order/{id}', [OrdersController::class, 'getOrder']);

