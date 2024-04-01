<?php

namespace App\Http\Controllers;

use App\Models\Conges;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\StoreCongesRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCongesRequest;

class CongesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $congesBd = Conges::all() ;
        $conges = [];

        foreach ($congesBd as $conge) {
            $user=$conge->user ;
           $items = (['conge'=>$conge , 'user'=>$user]) ;
           array_push($conges , $items) ;
        }

        return response()->json(['status'=>200 , 'conges'=>$conges]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       $validator = Validator::make($request->all() ,[
        'matricule'=> 'required|string' ,
        'debut'=>'required|date' ,
        'fin'=>'required|date' ,
        
    ]) ;



    if($validator->fails()){
        return response()->json(
            [
                'status'=> false,
                 'message'=>$validator->errors()

            ] , 422
        ) ;
    }

    $user = User::where('matricule' ,'=', $request->matricule)->first() ;

    $conge =Conges::create([...$request->except('matricule') , 'user_id'=>$user->id ]) ;

    return response()->json(['status' =>true ,

            'conge'=>$conge , 'user'=>$user

    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conges $conges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conges $conges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCongesRequest $request, Conges $conges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conges $conges)
    {
        //
    }
}
