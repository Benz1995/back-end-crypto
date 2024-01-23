<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FiatController;
use App\Http\Controllers\Api\CryptoCurrenciesController;
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
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout',[UserController::class,'logout']);
Route::group(["middleware" => ["auth:api"]], function(){
    // Fiats User 
    // Route::post('/logout',[UserController::class,'logout']);
    Route::post('/password',[UserController::class,'resetpassword']);


    // Fiats Currencies CRUD
    Route::post('fiats', [FiatController::class, 'store']);
    Route::get('fiats', [FiatController::class, 'index']);
    Route::get('fiats/{fiat}', [FiatController::class, 'show']);
    Route::put('fiats/{fiat}', [FiatController::class, 'update']);
    Route::delete('fiats/{fiat}', [FiatController::class, 'destroy']);


    // CryptoCurrencies CRUD
    Route::post('crypto-currency', [CryptoCurrenciesController::class, 'store']);
    Route::get('crypto-currency', [CryptoCurrenciesController::class, 'index']);
    Route::get('crypto-currency/{crypto}', [CryptoCurrenciesController::class, 'show']);
    Route::put('crypto-currency/{crypto}', [CryptoCurrenciesController::class, 'update']);
    Route::delete('crypto-currency/{crypto}', [CryptoCurrenciesController::class, 'destroy']);
});