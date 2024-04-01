<?php

namespace App\Http\Controllers;

use App\Models\Sanction;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSanctionRequest;
use App\Http\Requests\UpdateSanctionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class SanctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanctionBd = Sanction::all() ;
        $sanctions = [];

        foreach ($sanctionBd as $sanction) {
            $user=$sanction->user ;
           $items = (['sanction'=>$sanction , 'user'=>$user]) ;
           array_push($sanctions , $items) ;
        }

        return response()->json(['status'=>200 , 'sanctions'=>$sanctions]) ;
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
            'motif'=>'required|string' ,
            'date'=>'required|date' ,
            'date'=>'required|date' ,
            
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

        $sanction =Sanction::create([...$request->except('matricule') , "user_id" =>$user->id, "commentaire"=>"" , 'status'=>0]) ;

        return response()->json(['status' =>true ,

                'sanction'=>$sanction , "user"=>$user

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sanction $sanction)
    {
        return response()->json(['status'=>200 , 'sanction'=>$sanction]) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sanction $sanction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanctionRequest $request, Sanction $sanction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sanction $sanction)
    {
        //
    }
}
