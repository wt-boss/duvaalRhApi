<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function getStatDatas(){
        

        return response()->json(['status'=>200 ]) ;
    }
}
