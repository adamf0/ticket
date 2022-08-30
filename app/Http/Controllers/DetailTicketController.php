<?php

namespace App\Http\Controllers;

use App\Tickets;
use App\Chats;
use App\PicMember;
use Session;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class DetailTicketController extends Controller
{
    public function __construct(){
        // if(!Session::has('id_user')){
        //     return \Redirect::to('/')->send();
        // }
        // \Debugbar::enable();
        // dd(Session::all());
    }

    public function index($id){
        ///get all nik///
        $a1 = Tickets::select('id_user')->groupBy('id_user')->get()->pluck('id_user')->toArray();
        $a2 = Tickets::select('id_user_pic')->groupBy('id_user_pic')->get()->pluck('id_user_pic')->toArray();
        $b1 = Chats::select('to_user')->get()->pluck('to_user')->toArray();
        $b2 = Chats::select('from_user')->get()->pluck('from_user')->toArray();       
        $c1 = PicMember::select('id_user')->groupBy('id_user')->get()->pluck('id_user')->toArray();
        $listNik = array_values(array_unique(array_merge($a1,$a2,$b1,$b2,$c1)));
        $nik = '';
        
        foreach($listNik as $key => $value){
            if($key==count($listNik)-1){
                $nik .= "'$value'";
            }
            else{
                $nik .= "'$value',";
            }
        }
        ///end get all nik///
        
        try{
            ///get all user///
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://cb.web.id/ggklikv2/api/getAllUser', []);
            $responseBody = json_decode($response->getBody());
            
            if($response->getStatusCode() != 200){
                session(['type_modal' => 'fail', 'message' => 'Ada Masalah Padda server']);
                return redirect()->route('ticket.index');
            }
            // $users = collect($responseBody->listdata);
            ///end get all user///
            
            ///get all user in///
            $response = $client->request('POST', 'https://cb.web.id/ggklikv2/api/getAllUserIn', ['form_params' => ['nik' => $nik]]);
            $responseBody = json_decode($response->getBody());
            
            if($response->getStatusCode() != 200){
                session(['type_modal' => 'fail', 'message' => 'Ada Masalah Padda server']);
                return redirect()->route('ticket.index');
            }
            $listUser = collect($responseBody->listdata);        
            ///get all user in///

            $ticket = Tickets::with(['progress','pic_member'])
                        ->findOrFail($id);
            $check = PicMember::where(["id_ticket"=>$ticket->id,"id_user"=>Session::get('id_user')])->get()->count();
            $ticket->is_member = $check>0;

            $this->mappingDataDetail($ticket,$listUser);

            $chats = Chats::where('id_ticket',$id)->get();
            $chats->each(function ($c) use($listUser){
                $this->mappingDataChat($c,$listUser);
            });
            // dd($listUser,$ticket,$chats,$users);

            return view('index',[
                "parentview"=>'detail',
                "subview"=>'',
                "ticket"=>$ticket,
                "chats"=>$chats,
            ]);
        } catch (ClientException $e) {
            session(['type_modal' => 'fail', 'message' => Psr7\Message::toString($e->getResponse()) ]);

            return view('index',[
                "parentview"=>'detail',
                "subview"=>'',
                "ticket"=>null,
                "chats"=>[],
            ]);
        }
    }
    function mappingDataDetail($ticket,$listUser){
        $user = $listUser->filter(function($u) use ($ticket) {
            return $u->nik==$ticket->id_user;
        })->values();
        $userPic = $listUser->filter(function($u) use ($ticket) {
            return $u->nik==$ticket->id_user_pic;
        })->values();

        // unset($ticket->id_user);
        $ticket->user = $user;
        // unset($ticket->id_user_pic);
        $ticket->userPic = $userPic;

        $ticket->pic_member->each(function ($listMember) use($listUser){
            $user = $listUser->filter(function($u) use ($listMember) {
                return $u->nik==$listMember->id_user;
            })->values()->toArray();
            // unset($listMember->id_user);
            $listMember->user = $user;
        });

        return $ticket;
    }
    function mappingDataChat($chat,$listUser){
        $toUser = $listUser->filter(function($u) use ($chat) {
            return $u->nik==$chat->to_user;
        })->values();
        $fromUser = $listUser->filter(function($u) use ($chat) {
            return $u->nik==$chat->from_user;
        })->values();

        // unset($c->id_user);
        $chat->to_user_ = $toUser;
        // unset($c->id_user_pic);
        $chat->from_user_ = $fromUser;

        return $chat;
    }
}
