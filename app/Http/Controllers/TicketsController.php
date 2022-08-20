<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Chats;

class TicketsController extends Controller
{
    public function __construct(){
        session(['level_user' => "3"]);
    }
    public function index(){
        return view('index',[
            "parentview"=>'ticket',
            "subview"=>'',
            "tickets"=>Tickets::all()
        ]);
    }
    public function detail($id){
        return view('index',[
            "parentview"=>'ticket',
            "subview"=>'detail',
            "ticket"=>Tickets::with(['Users','progress'])->findOrFail($id),
            "chats"=>Chats::where('id_ticket',$id)->get()
        ]);
    }
    public function add(){
        return view('index',[
            "parentview"=>'ticket',
            "subview"=>'create'
        ]);
    }

    public function create(Request $req){
        $ticket = new Tickets();
        $ticket->id_user = $req->id_user;
        if($req->type_ticket==0){
            $ticket->no_ticket = "T.".rand();
        }
        else if($req->type_ticket==1){
            $ticket->no_ticket = "P.".rand();
        }
        else{
            $ticket->no_ticket = "M.".rand();
        }
        $ticket->type_ticket = $req->type_ticket;
        $ticket->label = $req->label;
        $ticket->judul = $req->judul;
        $ticket->deskripsi = $req->deskripsi;
        $ticket->foto = '';
        $ticket->status = 0;

        if($ticket->save()){
            session(['type_modal' => 'success', 'message' => 'berhasil simpan']);
            return redirect()->route('ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal simpan']);
            return redirect()->route('ticket.index');
        }
    }

    public function destroy($id){
        $ticket = Tickets::findOrFail($id);
        $ticket->id_user = $ticket->id_user;
        $ticket->no_ticket = $ticket->no_ticket;
        $ticket->type_ticket = $ticket->type_ticket;
        $ticket->label = $ticket->label;
        $ticket->judul = $ticket->judul;
        $ticket->deskripsi = $ticket->deskripsi;
        $ticket->foto = $ticket->foto;
        $ticket->status = 2;
        if($ticket->save()){
            session(['type_modal' => 'success', 'message' => 'berhasil hapus']);
            return redirect()->route('ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal hapus']);
            return redirect()->route('ticket.index');
        }
    }
}
