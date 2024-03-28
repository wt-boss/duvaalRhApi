<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['success'=>true ,'users'=>$users ]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['name', 'email']) ,[
            'name'=> 'required|string' ,
            'email'=>'required|email' ,
            
        ]) ;

        if($validator->fails()){
            return response()->json(
                [
                    'status'=> false,
                    'message'=>$validator->errors()

                ] , 422
            ) ;
        }

        $user =User::create([...$request->all() , "password" =>"123456" , "role_id"=>3]) ;

        return response()->json(['status' =>true ,
                'user'=>$user 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
