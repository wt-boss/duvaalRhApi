<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePresenceRequest;
use App\Http\Requests\UpdatePresenceRequest;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presenceBd = Presence::all() ;
        $presences = [];

        foreach ($presenceBd as $presence) {
            $user=$presence->user ;
           $items = (['presence'=>$presence , 'user'=>$user]) ;
           array_push($presences , $items) ;
        }

        return response()->json(['status'=>200 , 'presences'=>$presences]) ;
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
            'date'=>'required|date' ,
            'heures'=>'required|integer' ,
            
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

        $presence =Presence::create([...$request->except('matricule') , 'user_id'=>$user->id ]) ;

        return response()->json(['status' =>true ,

                'presence'=>$presence , 'user'=>$user

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresenceRequest $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
