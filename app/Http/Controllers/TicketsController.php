<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Chats;
use App\Models\Users;
use Session;

class TicketsController extends Controller
{
    public function __construct(){
        if(!Session::has('id_user')){
            return \Redirect::to('/')->send();
        }
        // \Debugbar::enable();
        // dd(Session::all());
    }
    public function index(){
        if(Session::get('level_user')==1){
            $datas = Tickets::with(['users','progress','pic_member'])->get();
        }
        else if(Session::get('level_user')==2){
            $datas = Tickets::with(['users','progress','pic_member'])->where('status','1')->get();
        }
        else{
            $datas = Tickets::with(['Users','progress','pic_member'])->where('status','0')->get();
        }

        return view('index',[
            "parentview"=>'ticket',
            "subview"=>'',
            "tickets"=>$datas,
            "users"=>Users::all()
        ]);
    }
    public function detail($id){
        return view('index',[
            "parentview"=>'ticket',
            "subview"=>'detail',
            "ticket"=>Tickets::with(['Users','progress','pic_member'])->findOrFail($id),
            "chats"=>Chats::where('id_ticket',$id)->get(),
            "users"=>Users::all()
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
        // $ticket->id_user = $req->id_user;
        $ticket->id_user = Session::get('id_user');
        if($req->type_ticket==0){
            $ticket->no_ticket = "T".rand();
        }
        else if($req->type_ticket==1){
            $ticket->no_ticket = "P".rand();
        }
        else{
            $ticket->no_ticket = "M".rand();
        }
        $ticket->type_ticket = $req->type_ticket;
        $ticket->label = $req->label;
        $ticket->judul = $req->judul;
        $ticket->deskripsi = $req->deskripsi;
        if($req->hasFile('foto')){
            $ticket->foto = $req->file('foto')->getClientOriginalName();
            $req->file('foto')->move(public_path() . '/ticket',$req->file('foto')->getClientOriginalName());
        }
        $ticket->status = 0;
        $ticket->createdBy = Session::get('id_user');
        // dd($ticket);

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
