<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoCurrencies;

class CryptoCurrenciesController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    public function index()
    {
        return CryptoCurrencies::all();
    }

    public function store(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'name'      => 'required|string|min:3|max:125',       
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{
            if (CryptoCurrencies::where('cyt_name', $request->name)->count() == 0) {
                $CryptoCurrencies = CryptoCurrencies::create([
                    'cyt_name'=>$request->name
                ]);
                return response()->json(["status"=> "success",'data'=>$CryptoCurrencies], $this->successStatus);
            }
            return response()->json(null, $this->failStatus);
        }
    }

    public function show(CryptoCurrencies $crypto_currency)
    {
        return response()->json($crypto_currency);
    }

    public function update(Request $request, CryptoCurrencies $crypto_currency)
    {;
        $crypto_currency->update([
            'cyt_name'=>$request->name
        ]);
        return response()->json($crypto);
        
    }

    public function destroy(CryptoCurrencies $crypto_currency)
    {
        $crypto_currency->delete();

        return response()->json(null, 204);
    }

    public function listCrytpo()
    {
        $Cryptos = CryptoCurrencies::all();
        foreach ($Cryptos as $item) {
            $resultCrypto[] = [
                'cyt_id' => $item['cyt_id'],
                'cyt_name' => $item['cyt_name'],
            ];
        }

        return $resultCrypto;
    }
}
