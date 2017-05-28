<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\soumission;
use App\user;
use App\character;

class controle_whitelist extends Controller
{
    public function record_dem(Request $request)
    {   	
    	$soumission = new soumission;
    	$soumission->user_id=$request->user;
        $soumission->nom=$request->nom;
        $soumission->prenom=$request->prenom;
        $soumission->description=$request->description;
        $soumission->reason=$request->reason;
        $soumission->steamid=$request->steamid;
        $soumission->save();
    }
    public function ajout_whitelist(Request $request)
    {
        $user_id = $request->user;
        $user = user::where ('id', $user_id)->first();
        $user->whitelist = '1';
        $user->save();
        $char = new character;
        $char->steamid = $request->steamid;
        $char->prenom = $request->prenom;
        $char->nom = $request->nom;
        $char->description = $request->description;
        $char->save();

    }
    public function refus_whitelist(Request $request)
    {
        $req_id = $request->req_id;
        $req = soumission::where('id',$req_id)->first();
        $req->delete();
    }
    public function ban_steamid(Request $request)
    {
        $steamid = $request->steamid;
        $user = user::where('steamid',$steamid)->first();
        $user->whitelist = '0';
        $user->save();
    }
}
