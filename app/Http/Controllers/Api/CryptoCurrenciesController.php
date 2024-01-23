<?php

namespace App\Http\Controllers\Api;
use App\Models\CryptoCurrencies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function show(CryptoCurrencies $crypto)
    {
        return response()->json($crypto);
    }

    public function update(Request $request, CryptoCurrencies $crypto)
    {
        try {
            $crypto->update([
                'cyt_name'=>$request->name
            ]);
            return response()->json($crypto);
        } catch (ModelNotFoundException $exception) {
            return back()->withError('User with ID: '.$request->user_id.' not found!')->withInput();
        } catch (RelationNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function destroy(CryptoCurrencies $crypto)
    {
        $fiat->delete();

        return response()->json(null, 204);
    }
}
