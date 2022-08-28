<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardItemTicketActive extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $index = 0;
    public $createdat = "0000-00-00";
    public $no_ticket = '';
    public $label = 0;
    public $judul = '';
    public $deskripsi = '';
    public $foto = '';
    public $userPic = '';
    public $memberPic = '';
    public $status = 0;

    public function __construct($index=0,$createdat="0000-00-00",$noticket='',$label=0,$judul='',$deskripsi='',$foto='',$userPic='',$memberPic='',$status=0)
    {
        $this->index = $index;
        $this->createdat = $createdat;
        $this->no_ticket = $noticket;
        $this->label = $label;
        $this->judul = $judul;
        $this->memberPic = json_decode($memberPic,true);
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
        // dd($this);
        return view('components.dashboard-item-ticket-active',[
            "index" => $this->index,
            "created_at" => $this->createdat,
            "no_ticket" => $this->no_ticket,
            "label" => $this->label,
            "judul" => $this->judul,
            "deskripsi" => $this->deskripsi,
            "foto" => $this->foto,
            "userPic" => $this->userPic,
            "memberPic" => $this->memberPic,
            "status" => $this->status
        ]);
    }
}
