<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
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
        $transaction = Transaction::where('user_id', $this->authUser->user_id)->get();
        return response()->json($transaction);
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
            'user_id'           => 'required', 
            'exchange_id'       => 'required', 
            'cyt_id'            => 'required',       
            'wallet_id'         => 'required',       
            'fiat_id'           => 'required',       
            'cyt_amount'        => 'required',
            'fiat_amount'       => 'required',   
            'type'              => 'required',     
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{  
            $transaction = Transaction::create([
                'user_id'=>$this->authUser->user_id,
                'exchange_id'=> $request->exchange_id,
                'cyt_id'=>$request->cyt_id,
                'wallet_id'=> $request->wallet_id,
                'fiat_id'=> $request->fiat_id,
                'type'=>$request->type,
                'cyt_amount'=> $request->amount ? $request->amount : 0,
                'fiat_amount'=> $request->amount ? $request->amount : 0
            ]);
            return response()->json(["status"=> "success",'data'=>$transaction], $this->successStatus);     
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        $transactionData = Transaction::where('user_id', $this->authUser->user_id)
        ->where('transaction_id', $transaction)->get();
        return response()->json($transactionData);
    }

}
