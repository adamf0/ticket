<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Chats;
use App\Models\PicMember;
use Session;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class DetailTicketController extends Controller
{
    public function __construct(){
        if(!Session::has('id_user')){
            return \Redirect::to('/')->send();
        }
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

            ///mapping ticket with data user from server///
            $ticket = Tickets::with(['progress','pic_member'])->findOrFail($id);
            $user = $listUser->filter(function($u) use ($ticket) {
                return stripos($u->nik,$ticket->id_user) !== false;
            })->values();
            $userPic = $listUser->filter(function($u) use ($ticket) {
                return stripos($u->nik,$ticket->id_user_pic) !== false;
            })->values();

            unset($ticket->id_user);
            $ticket->user = $user;
            unset($ticket->id_user_pic);
            $ticket->userPic = $userPic;

            $ticket->pic_member->each(function ($listMember) use($listUser){
                $user = $listUser->filter(function($u) use ($listMember) {
                    return stripos($u->nik,$listMember->id_user) !== false;
                })->values()->toArray();
                unset($listMember->id_user);
                $listMember->user = $user;
            });
            ///end mapping ticket with data user from server///

            $chats = Chats::where('id_ticket',$id)->get();
                $chats->each(function ($c) use($listUser){
                    $toUser = $listUser->filter(function($u) use ($c) {
                        return stripos($u->nik,$c->to_user) !== false;
                    })->values();
                    $fromUser = $listUser->filter(function($u) use ($c) {
                        return stripos($u->nik,$c->from_user) !== false;
                    })->values();

                    unset($c->id_user);
                    $c->to_user = $toUser;
                    unset($c->id_user_pic);
                    $c->from_user = $fromUser;
                });
            ///end mapping ticket with data user from server///
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
}
