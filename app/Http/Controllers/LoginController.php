<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function dologin(Request $req){
        $user = Users::where('nik',$req->nik)->where('password',md5($req->password))->first();

        if($user){
            session(['level_user' => $user->level,'id_user'=>$user->id]);
            session(['type_modal' => 'success', 'message' => 'berhasil login']);
            return redirect()->route('ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal login']);
            return redirect()->route('login');
        }
    }
    public function logout(){
        Session::forget('level_user');
        Session::forget('id_user');
        // dd(Session::all());
        return redirect()->route('login');
    }
}
