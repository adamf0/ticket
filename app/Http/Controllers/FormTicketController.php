<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use Session;

class FormTicketController extends Controller
{
    public function index($type='troubleshoot'){
        return view('index',[
            "parentview"=>'form-ticket',
            "subview"=>'',
            'type'=>$type
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
            session(['type_modal' => 'success', 'message' => 'berhasil tambah tiket']);
            return redirect()->route('my-ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal tambah tiket']);
            return redirect()->route('form-ticket.index');
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
            session(['type_modal' => 'success', 'message' => 'berhasil tutup tiket']);
            return redirect()->route('my-ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal tutup tiket']);
            return redirect()->route('my-ticket.index');
        }
    }

}
