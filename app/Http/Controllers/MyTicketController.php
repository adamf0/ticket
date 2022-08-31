<?php

namespace App\Http\Controllers;

use App\Tickets;
use App\Chats;
use App\PicMember;
use Session;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class MyTicketController extends Controller
{
    public function __construct(){
        // if(!Session::has('id_user')){
        //     return \Redirect::to('/')->send();
        // }
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
                $ticket = Tickets::with(['progress','pic_member'])
                            ->where('id_user',Session::get('id_user'))
                            ->get();
                $ticket = $this->mappingData($ticket,$listUser);

                $datas = (object) [
                    "pribadi"=>$ticket,
                    "total_waiting"=>Tickets::with(['progress','pic_member'])
                                        ->where('id_user',Session::get('id_user'))
                                        ->whereIn('status',[0,1])
                                        ->get()->count()
                ]; 
            }
            else if(Session::get('level_user')==2){
                $pribadi = Tickets::with(['progress','pic_member'])
                            ->where('id_user',Session::get('id_user'))
                            ->get();
                $tugas = Tickets::with(['progress','pic_member'])
                            ->where('id_user_pic',Session::get('id_user'))
                            ->where('status',1)
                            ->get()
                            ->each(function($t){
                                $t->is_member = false;
                            });
                $data_member = \DB::table('ticket as t')
                                ->select('t.id', 't.no_ticket', 't.id_user', 't.id_user_pic', 'tm.id_user as id_member')
                                ->crossJoin('ticket_pic_member as tm',function($join){
                                    $join->on('t.id','=','tm.id_ticket');
                                })
                                ->where('tm.id_user',Session::get('id_user'))
                                ->get()
                                ->pluck('id')
                                ->toArray();

                if(count($data_member)>0){
                    $tugas = $tugas->merge(
                                Tickets::with(['progress','pic_member'])
                                ->whereIn('id',$data_member)
                                ->where('status',1)
                                ->get()
                                ->each(function($t){
                                    $t->is_member = true;
                                })
                    );
                }

                $tugas = $this->mappingData($tugas,$listUser);
                $pribadi = $this->mappingData($pribadi,$listUser);

                $datas = (object) [
                    "tugas"=>$tugas,
                    "pribadi"=>$pribadi,
                    "total_waiting"=>Tickets::with(['progress','pic_member'])
                                        ->where('id_user',Session::get('id_user'))
                                        ->whereIn('status',[0,1])
                                        ->get()->count()
                ];
            }
            else{
                $pribadi = Tickets::with(['progress','pic_member'])
                            ->where('id_user',Session::get('id_user'))
                            ->get();
                $tugas = Tickets::with(['progress','pic_member'])
                            // ->where('id_user_pic',Session::get('id_user'))
                            ->get()
                            ->each(function($t){
                                $t->is_member = false;
                            });;
                $data_member = \DB::table('ticket as t')
                                ->select('t.id', 't.no_ticket', 't.id_user', 't.id_user_pic', 'tm.id_user as id_member')
                                ->crossJoin('ticket_pic_member as tm',function($join){
                                    $join->on('t.id','=','tm.id_ticket');
                                })
                                ->where('tm.id_user',Session::get('id_user'))
                                ->get()
                                ->pluck('id')
                                ->toArray();

                if(count($data_member)>0){
                    $tugas = $tugas->merge(
                                Tickets::with(['progress','pic_member'])
                                ->whereIn('id',$data_member)
                                // ->where('status',1)
                                ->get()
                                ->each(function($t){
                                    $t->is_member = true;
                                })
                    );
                }

                $tugas = $this->mappingData($tugas,$listUser);
                $pribadi = $this->mappingData($pribadi,$listUser);

                $datas = (object) [
                    "tugas"=>$tugas,
                    "pribadi"=>$pribadi,
                    "total_waiting"=>Tickets::with(['progress','pic_member'])
                                        ->where('id_user',Session::get('id_user'))
                                        ->whereIn('status',[0,1])
                                        ->get()->count()
                ];
            }
            // dd($datas);

            return view('index',[
                "parentview"=>"my-ticket",
                "subview"=>"",
                "tickets"=>$datas,
                "users"=>$users
            ]);
        } catch (ClientException $e) {
            $datas = (object) [
                "tugas"=>[],
                "pribadi"=>[],
                "total_waiting"=>0
            ];
            $users = [];
            session(['type_modal' => 'fail', 'message' => Psr7\Message::toString($e->getResponse()) ]);

            return view('index',[
                "parentview"=>"my-ticket",
                "subview"=>"",
                "tickets"=>$datas,
                "users"=>$users
            ]);
        }
    }

    function mappingData($list_ticket,$listUser){
        return $list_ticket->each(function ($t) use($listUser){
            $user = $listUser->filter(function($u) use ($t) {
                return $u->nik==$t->id_user;
            })->values();
            $userPic = $listUser->filter(function($u) use ($t) {
                return $u->nik==$t->id_user_pic;
            })->values();

            // unset($t->id_user);
            $t->user = $user;
            // unset($t->id_user_pic);
            $t->userPic = $userPic;

            $t->pic_member->each(function ($listMember) use($listUser){
                $user = $listUser->filter(function($u) use ($listMember) {
                    return $u->nik==$listMember->id_user;
                })->values()->toArray();
                // unset($listMember->id_user);
                $listMember->user = $user;
            });
        });
    }
}
