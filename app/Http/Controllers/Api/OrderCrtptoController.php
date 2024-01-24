<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCrtpto;

class OrderCrtptoController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    private $alreadyStatus              =   208;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderCrtpto::all();
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
            'user_id'      => 'required', 
            'cyt_id'       => 'required',       
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{  
            $order = OrderCrtpto::create([
                'user_id'=>$request->user_id,
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
    public function show(OrderCrtpto $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = OrderCrtpto::where('user_id',$request->user_id)
        ->where('order_id ', $request->order_id)
        ->update([
            'user_id'=>$request->user_id,
            'cyt_id'=>$request->cyt_id,
            'type'=>$request->type,
            'cyt_amount'=> $request->amount ? $request->amount : 0
        ]);
        return response()->json($order);
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
        $order = OrderCrtpto::where('user_id',$request->user_id)
        ->where('order_id', $order_id)
        ->delete();
        return response()->json(null, 204);
    }
}
