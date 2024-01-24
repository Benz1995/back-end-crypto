<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FiatController;
use App\Http\Controllers\Api\CryptoCurrenciesController;
use App\Http\Controllers\Api\RoleUsersController;
use App\Http\Controllers\Api\UserWalletController;
use App\Http\Controllers\Api\OrderCrtptoController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ExchangeController;
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
    $authUserCheck = auth('api')->user();
    if($authUserCheck != NULL){  
        if($authUserCheck->is_admin == 1){
            Route::get('listcrytpo', [CryptoCurrenciesController::class, 'listCrytpo']);
            Route::resources([
                // Fiats Currency CRUD
                'fiats' => FiatController::class,
                'crypto-currencys' => CryptoCurrenciesController::class,
                // Roles Users CRUD
                'roles' => RoleUsersController::class,
            ]);
        }else{
            Route::post('/password',[UserController::class,'resetPassword']);
            Route::get('/users/me',[UserController::class,'userDetail']);
            Route::post('/user/edit',[UserController::class,'update']);
            Route::post('/logout',[UserController::class,'logout']);

            Route::resources([
                'wallets' => UserWalletController::class,
                // Orders CRUD
                'orders' => OrderCrtptoController::class,
            ]);
            // Transaction Add and view 
            Route::post('/transactions',[TransactionController::class,'store']);
            Route::get('/transactions/{transaction}',[TransactionController::class,'show']);
            Route::get('/transactions',[TransactionController::class,'index']);

            Route::post('/exchanges',[ExchangeController::class,'store']);
            Route::get('/exchanges/{exchange}',[ExchangeController::class,'show']);
            Route::get('/exchanges',[ExchangeController::class,'index']);

            Route::get('/listcrytpo',[CryptoCurrenciesController::class,'listCrytpo']);

        }
    }
});