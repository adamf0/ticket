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
    public $created_at = "0000-00-00";
    public $no_ticket = '';
    public $label = 0;
    public $judul = '';
    public $deskripsi = '';
    public $foto = '';
    public $userPic = '';
    public $status = 0;

    public function __construct($index=0,$created_at="0000-00-00",$no_ticket='',$label=0,$judul='',$deskripsi='',$foto='',$userPic='',$status=0)
    {
        $this->index = $index;
        $this->created_at = \Carbon\Carbon::parse($created_at)->format("l, j F Y");
        $this->no_ticket = $no_ticket;
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
        return view('components.dashboard-item-ticket-active',[
            "created_at" => $this->index,
            "no_ticket" => $this->no_ticket,
            "label" => $this->label,
            "judul" => $this->judul,
            "deskripsi" => $this->deskripsi,
            "foto" => $this->foto,
            "userPic" => $this->userPic,
            "status" => $this->status
        ]);
    }
}