<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Chats;
use App\Models\Users;
use Session;

class MyTicketController extends Controller
{
    public function __construct(){
        if(!Session::has('id_user')){
            return \Redirect::to('/')->send();
        }
        // \Debugbar::enable();
        // dd(Session::all());
    }
    public function index(){
        $id_user = Session::get('id_user');

        ///get all nik///
        $a1 = Tickets::select('id_user')->groupBy('id_user')->get()->pluck('id_user')->toArray();
        $a2 = Tickets::select('id_user_pic')->groupBy('id_user_pic')->get()->pluck('id_user_pic')->toArray();
        $b1 = Chats::select('to_user')->get()->pluck('to_user')->toArray();
        $b2 = Chats::select('from_user')->get()->pluck('from_user')->toArray();       
        $listNik = array_values(array_unique(array_merge($a1,$a2,$b1,$b2)));
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

        ///get all user in///
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://cb.web.id/ggklikv2/api/getAllUserIn', ['form_params' => ['nik' => $nik]]);
        $responseBody = json_decode($response->getBody());

        if($response->getStatusCode() != 200){
            session(['type_modal' => 'fail', 'message' => 'Ada Masalah Padda server']);
            return redirect()->route('ticket.index');
        }
        $listUser = collect($responseBody->listdata);
        ///end get all user in///

        ///get all user///
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://cb.web.id/ggklikv2/api/getAllUser', []);
        $responseBody = json_decode($response->getBody());
        
        if($response->getStatusCode() != 200){
            session(['type_modal' => 'fail', 'message' => 'Ada Masalah Padda server']);
            return redirect()->route('ticket.index');
        }
        $users = collect($responseBody->listdata);
        ///end get all user///
        
        if(Session::get('level_user')==1){
            ///mapping ticket with data user from server///
            $ticket = Tickets::with(['progress'])->where('id_user',Session::get('id_user'))->get();
            $ticket->each(function ($t) use($listUser){
                $user = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user) !== false;
                })->values();
                $userPic = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user_pic) !== false;
                })->values();

                unset($t->id_user);
                $t->user = $user;
                unset($t->id_user_pic);
                $t->userPic = $userPic;
            });
            ///end mapping ticket with data user from server///

            $datas = $ticket->filter(function($t) use ($id_user) {
                if(count($t->user)==0){
                    return true;
               }
               else{
                    return stripos($t->user[0]->nik,$id_user) !== false;
               }
            })->values();
            $total_waiting = count($ticket->whereIn('status', [0,1])->all());

            $datas = (object) [
                "pribadi"=>$datas,
                "total_waiting"=>$total_waiting
            ]; 
        }
        else if(Session::get('level_user')==2){
            ///mapping ticket with data user from server///
            $ticket = Tickets::with(['progress'])->get();

            $ticket->each(function ($t) use($listUser){
                $user = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user) !== false;
                })->values();
                $userPic = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user_pic) !== false;
                })->values();

                unset($t->id_user);
                $t->user = $user;
                unset($t->id_user_pic);
                $t->userPic = $userPic;
            });
            ///end mapping ticket with data user from server///

            $tugas = $ticket->filter(function($t) use ($id_user) {
                if(count($t->userPic)==0){
                     return true;
                }
                else{
                    return stripos($t->userPic[0]->nik,$id_user) !== false;
                }
            })->values();
            $pribadi = $ticket->filter(function($t) use ($id_user) {
               if(count($t->user)==0){
                    return true;
               }
               else{
                    return stripos($t->user[0]->nik,$id_user) !== false;
               }
            })->values();

            $datas = (object) [
                "tugas"=>$tugas,
                "pribadi"=>$pribadi,
                "total_waiting"=>-1
            ];
        }
        else{ 
            ///mapping ticket with data user from server///
            $ticket = Tickets::with(['progress'])->get();
            $ticket->each(function ($t) use($listUser){
                $user = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user) !== false;
                })->values();
                $userPic = $listUser->filter(function($u) use ($t) {
                    return stripos($u->nik,$t->id_user_pic) !== false;
                })->values();

                unset($t->id_user);
                $t->user = $user;
                unset($t->id_user_pic);
                $t->userPic = $userPic;
            });
            ///end mapping ticket with data user from server///

            $tugas = $ticket;
            $pribadi = $ticket->filter(function($t) use ($id_user) {
                return stripos($t->user[0]->nik,$id_user) !== false;
            })->values();
            $total_waiting = count($pribadi->whereIn('status', [0,1])->all());

            $datas = (object) [
                "tugas"=>$tugas,
                "pribadi"=>$pribadi,
                "total_waiting"=>$total_waiting
            ];
        }
        // dd($datas);

        return view('index',[
            "parentview"=>"my-ticket",
            "subview"=>"",
            "tickets"=>$datas,
        ]);
        // return view('template');
    }
}
