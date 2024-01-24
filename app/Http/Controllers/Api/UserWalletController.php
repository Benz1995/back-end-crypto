<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserWallet;

class UserWalletController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    private $unauthorisedlStatus        =   401;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserWallet::all();
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
            $wallet = UserWallet::create([
                'user_id'=>$request->user_id,
                'cyt_id'=>$request->cyt_id,
                'amount'=> $request->amount ? $request->amount : 0
            ]);
            return response()->json(["status"=> "success",'data'=>$wallet], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserWallet $wallet)
    {
        return response()->json($wallet);
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
        $wallet = UserWallet::where('user_id',$request->user_id)
        ->where('cyt_id', $request->cyt_id)
        ->update([
            'amount'=>$request->amount
        ]);

        $updatedWallet = UserWallet::where('user_id', $request->user_id)
        ->where('cyt_id', $request->cyt_id)
        ->first();

        return response()->json($updatedWallet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $wallet = UserWallet::where('user_id',$request->user_id)->delete();
        return response()->json(null, 204);
    }
}
