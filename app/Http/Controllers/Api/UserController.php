<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\UserWalletController;

class UserController extends Controller
{
    private $successStatus              =   200;
    private $failStatus                 =   404;
    private $unauthorisedlStatus        =   401;
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['user_id']     =       $user->user_id;
            $success['name']        =       $user->name;
            $success['email']       =       $user->email;
            $success['username']    =       $user->username;
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(null, $this->unauthorisedlStatus); 
        } 
    }
    public function register(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'name'      => 'required|string|min:3|max:125',
            'email'     => 'required|string|email|max:100|unique:users,email',
            'phone'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
           
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            $responseArr['token'] = '';
            return response()->json($responseArr, $this->failStatus);
        }else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password)
            ]);
            $success['user_id']     =       $user->user_id;
            $success['name']        =       $user->name;
            $success['email']       =       $user->email;
            $success['username']    =       $user->username;
            $success['token']       =       $user->createToken('MyApp')->accessToken; 
            return response()->json(['success'=>$success], $this->successStatus); 
        }
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password)
        ]);

        return response()->json($user);
    }

    public function resetPassword(Request $request, User $user)
    {
        $user->update([
            'password'=>bcrypt($request->password)
        ]);
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    public function logout(Request $request) {
        $Auth = Auth::logout();
        $success['user_id']     =      '';
        $success['name']        =      '';
        $success['email']       =      '';
        $success['username']    =      '';
        $success['token']       =      '';
        return response()->json($success, $this->successStatus);
    }

    public function userDetail(Request $request) {
        return $request->user();
    }
}
