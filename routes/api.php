<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FiatController;
use App\Http\Controllers\Api\CryptoCurrenciesController;
use App\Http\Controllers\Api\RoleUsersController;
use App\Http\Controllers\Api\UserWalletController;
use App\Http\Controllers\Api\OrderCrtptoController;
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
// User 
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);

Route::group(["middleware" => ["auth:api"]], function(){
    // User 
    Route::post('/password',[UserController::class,'resetPassword']);
    Route::get('/user',[UserController::class,'userDetail']);
    Route::post('/logout',[UserController::class,'logout']);
    // Get List Crytpo
    Route::get('listcrytpo', [CryptoCurrenciesController::class, 'listCrytpo']);
    Route::resources([
        // Fiats Currency CRUD
        'fiats' => FiatController::class,
        'crypto-currencys' => CryptoCurrenciesController::class,
        // Roles Users CRUD
        'roles' => RoleUsersController::class,
        // Wallets CRUD
        'wallets' => UserWalletController::class,
        // Orders CRUD
        'orders' => OrderCrtptoController::class
    ]);

});