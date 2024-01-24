<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCrtpto;
use Passport\Token;

class OrderCrtptoController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    private $alreadyStatus              =   208;
    private $authUser;
    private $isAdmin;
    function __construct() {
        $this->authUser = auth('api')->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = OrderCrtpto::where('user_id', $this->authUser->user_id)->get();
        return response()->json($order);
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
            'cyt_id'        => 'required',  
            'type'          => 'required',       
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{  
            $order = OrderCrtpto::create([
                'user_id'=>$this->authUser->user_id,
                'cyt_id'=>$request->cyt_id,
                'type'=>$request->type,
                'cyt_amount'=> $request->amount ? $request->amount : 0
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
    public function show(Request $request,$orderID)
    {
        $order = OrderCrtpto::where('user_id', $this->authUser->user_id)
        ->where('order_id', $orderID)
        ->first();
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$orderID)
    {
        $order = OrderCrtpto::where('user_id',$this->authUser->user_id)
        ->where('order_id', $orderID)
        ->update([
            'user_id'=>$this->authUser->user_id,
            'cyt_id'=>$request->cyt_id,
            'type'=>$request->type,
            'cyt_amount'=> $request->amount ? $request->amount : 0
        ]);
        $updatedOrder = OrderCrtpto::where('user_id',$this->authUser->user_id)
        ->where('order_id', $orderID)
        ->first();
        return response()->json($updatedOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order_id = $request->route('order');
        $order = OrderCrtpto::where('user_id',$this->authUser->user_id)
        ->where('order_id', $order_id)
        ->delete();
        return response()->json(null, 204);
    }
}
