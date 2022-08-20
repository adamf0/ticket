<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function create(Request $req,$id_ticket){
        $chat = new Progress();
        $chat->id_ticket = $id_ticket;
        $chat->deskripsi = $req->progress;
        
        if($chat->save()){
            session(['type_modal' => 'success', 'message' => 'berhasil simpan perkembangan']);
            return redirect()->route('ticket.detail',['id'=> $id_ticket]);
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal simpan perkembangan']);
            return redirect()->route('ticket.detail');
        }
    }
}
