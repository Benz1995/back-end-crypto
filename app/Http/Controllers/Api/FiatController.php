<?php

namespace App\Http\Controllers\Api;
use App\Models\FiatCurrency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FiatController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    public function index()
    {
        return FiatCurrency::all();
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
            if (FiatCurrency::where('fial_name', $request->name)->count() == 0) {
                $fiat = FiatCurrency::create([
                    'fial_name'=>$request->name
                ]);
                return response()->json(["status"=> "success",'data'=>$fiat], $this->successStatus);
            }
            return response()->json(null, $this->failStatus);
        }
    }

    public function show(FiatCurrency $fiat)
    {
        return response()->json($fiat);
    }

    public function update(Request $request, FiatCurrency $fiat)
    {
        $fiat->update([
            'fial_name'=>$request->name
        ]);

        return response()->json($fiat);
    }

    public function destroy(FiatCurrency $fiat)
    {
        $fiat->delete();

        return response()->json(null, 204);
    }
}
