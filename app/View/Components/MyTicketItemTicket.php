<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyTicketItemTicket extends Component
{
    public $index = 0;
    public $id = null;
    public $created_at = "0000-00-00"; //error
    public $nomor_ticket = ''; //error
    public $label = '0';
    public $judul = '';
    public $deskripsi = '';
    public $foto = '';
    public $userPic = '';
    public $status = '0';

    public function __construct($index=0,$id=null,$created_at="0000-00-00",$nomor_ticket='',$label='0',$judul='',$deskripsi='',$foto='',$userPic='',$status='0')
    {
        // dd($nomor_ticket);

        $this->index = $index;
        $this->id = $id;
        $this->created_at = $created_at;
        $this->nomor_ticket = $nomor_ticket;
        $this->label = $label;
        $this->judul = $judul;
        $this->deskripsi = $deskripsi;
        $this->foto = $foto;
        $this->userPic = $userPic;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // if($this->index==1) dd($this);
        return view('components.my-ticket-item-ticket',[
            "index" => $this->index,
            "id"=>$this->id,
            "nomor_ticket" => $this->nomor_ticket,
            "label" => $this->label,
            "judul" => $this->judul,
            "deskripsi" => $this->deskripsi,
            "foto" => $this->foto,
            "userPic" => $this->userPic,
            "status" => $this->status,
            "created_at" => $this->created_at
        ]);
    }
}
