<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyTicketItemTicket extends Component
{
    public $index = 0;
    public $id = null;
    public $created_at = "0000-00-00"; //error
    public $no_ticket = ''; //error
    public $label = '0';
    public $judul = '';
    public $deskripsi = '';
    public $foto = '';
    public $userPic = '';
    public $memberPic = '';
    public $status = '0';
    public $ismyticket = false;
    public $disabledetail = false;
    public $disabletutup = false;

    public function __construct($index=0,$id=null,$createdat="0000-00-00",$noticket='',$label='0',$judul='',$deskripsi='',$foto='',$userPic='',$memberPic='',$status='0',$ismyticket=false,$disabledetail=false,$disabletutup=false)
    {
        // dd($nomor_ticket);

        $this->index = $index;
        $this->id = $id;
        $this->created_at = $createdat;
        $this->no_ticket = $noticket;
        $this->label = $label;
        $this->judul = $judul;
        $this->deskripsi = $deskripsi;
        $this->foto = $foto;
        $this->userPic = $userPic;
        $this->memberPic = json_decode($memberPic,true);
        $this->status = $status;
        $this->ismyticket = $ismyticket;
        $this->disabledetail = $disabledetail;
        $this->disabletutup = $disabletutup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.my-ticket-item-ticket',[
            "index" => $this->index,
            "id"=>$this->id,
            "no_ticket" => $this->no_ticket,
            "label" => $this->label,
            "judul" => $this->judul,
            "deskripsi" => $this->deskripsi,
            "foto" => $this->foto,
            "userPic" => $this->userPic,
            "memberPic" => $this->memberPic,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "ismyticket"=>$this->ismyticket,
            "disabledetail"=>$this->disabledetail,
            "disabletutup"=>$this->disabletutup
        ]);
    }
}
