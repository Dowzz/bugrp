<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\soumission;
use App\user;

class demande_whitelist extends Controller
{
    public function record_dem(Request $request)
    {   	
    	$soumission = new soumission;
    	$soumission->user_id=$request->user;
        $soumission->nom=$request->nom;
        $soumission->prenom=$request->prenom;
        $soumission->description=$request->description;
        $soumission->reason=$request->reason;
        $soumission->save();
    }
    public function ajout_whitelist(Request $request)
    {
        $user_id = $request->user;
        $user = user::where ('id', $user_id)->first();
        $user->whitelist = '1';
        $user->save();

    }
    public function refus_whitelist(Request $request)
    {
        $req_id = $request->req_id;
        $req = soumission::where('id',$req_id)->first();
        $req->delete();
    }
}
