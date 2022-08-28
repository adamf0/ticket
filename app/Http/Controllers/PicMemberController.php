<?php

namespace App\Http\Controllers;

use App\Models\PicMember;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Session;

class PicMemberController extends Controller
{
    public function create(Request $req,$id_ticket){
        $pic = $req->pic;
        $member = $req->pic_member;
        $data_member = [];
        if ( isset($member) && count($member)>0 ) {
            if(($key = array_search($pic, $member)) !== false)
                unset($member[$key]);

            foreach($member as $m){
                array_push($data_member,["id_ticket"=>$id_ticket,"id_user"=>$m]);
            }
        }
        
        // dd($pic,$member,$data_member);
        $ticket = Tickets::findOrFail($id_ticket);
        $ticket->id_user_pic = $pic;
        $ticket->status = 1;
        $ticket->updatedBy = Session::get('id_user');

        if($ticket->save() && PicMember::insert($data_member)){
            session(['type_modal' => 'success', 'message' => 'berhasil simpan pic']);
            return redirect()->route('my-ticket.index');
        }
        else{
            session(['type_modal' => 'fail', 'message' => 'gagal simpan pic']);
            return redirect()->route('my-ticket.index');
        }
    }
}
