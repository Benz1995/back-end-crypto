<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exchange;

class ExchangeController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    private $alreadyStatus              =   208;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->authUser = auth('api')->user();
    }

    public function index()
    {
        $exchangeBuy = Exchange::where('buyer_user_id', $this->authUser->user_id)->get();
        $exchangeSell = Exchange::where('seller_user_id', $this->authUser->user_id)->get();
        $data = array_merge($exchangeBuy->toArray(),$exchangeSell->toArray());
        return response()->json($data);
        //return Exchange::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'buyer_user_id'     => 'required', 
            'seller_user_id'    => 'required', 
            'cyt_id'            => 'required',            
            'fiat_id'           => 'required',       
            'cyt_amount'        => 'required',
            'fiat_amount'       => 'required',   
            'type'              => 'required',     
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{  
            $order = Exchange::create([
                'buyer_user_id'=>$request->buyer_user_id,
                'seller_user_id'=> $request->seller_user_id,
                'cyt_id'=>$request->cyt_id,
                'fiat_id'=> $request->fiat_id,
                'type'=>$request->type,
                'cyt_amount'=> $request->amount ? $request->amount : 0,
                'fiat_amount'=> $request->amount ? $request->amount : 0
            ]);
            return response()->json(["status"=> "success",'data'=>$order], $this->successStatus);     
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($exchange)
    {
        $exchangeBuy = Exchange::where('buyer_user_id', $this->authUser->user_id)
        ->where('exchange_id', $exchange)->get();
        $exchangeSell = Exchange::where('seller_user_id', $this->authUser->user_id)
        ->where('exchange_id', $exchange)->get();
        $data = array_merge($exchangeBuy->toArray(),$exchangeSell->toArray());
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Exchange $exchange)
    {
        $exchange->update([
            'buyer_user_id'=>$request->buyer_user_id,
            'seller_user_id'=> $request->seller_user_id,
            'cyt_id'=>$request->cyt_id,
            'fiat_id'=> $request->fiat_id,
            'type'=>$request->type,
            'cyt_amount'=> $request->cyt_amount ? $request->cyt_amount : 0,
            'fiat_amount'=> $request->fiat_amount ? $request->fiat_amount : 0
        ]);

        return response()->json($exchange);
    }



}
