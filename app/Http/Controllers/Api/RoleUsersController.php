<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUsers;

class RoleUsersController extends Controller
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
        return RoleUsers::all();
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
            'name'      => 'required|string|min:3|max:125',       
        ]);
        
        if ($validator ->fails()) {
            $responseArr['message'] = $validator->errors();;
            return response()->json($responseArr, $this->failStatus);
        }else{
            if (RoleUsers::where('role_name', $request->name)->count() == 0) {
                $fiat = RoleUsers::create([
                    'role_name'=>$request->name
                ]);
                return response()->json(["status"=> "success",'data'=>$fiat], $this->successStatus);
            }
            return response();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RoleUsers $role)
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleUsers $role)
    {
        $role->update([
            'role_name'=>$request->name
        ]);

        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleUsers $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }
}
