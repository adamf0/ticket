<?php

namespace App\Http\Controllers;

use App\Models\Chats;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function create(Request $req,$id_ticket){
        $chat = new Chats();
        $chat->id_ticket = $id_ticket;
        $chat->deskripsi = $req->pesan;
        $chat->to_user = 1;
        $chat->from_user = 2;
        
        if($chat->save()){
            session(['type_modal' => 'success', 'message' => 'berhasil simpan chat']);
            return redirect()->route('ticket.detail',['id'=> $id_ticket]);
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal simpan chat']);
            return redirect()->route('ticket.detail');
        }
    }
}
