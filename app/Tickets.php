<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'ticket';

    public function progress()
    {
        return $this->hasMany(Progress::class,'id_ticket');
    }
    public function pic_member()
    {
        return $this->hasMany(PicMember::class,'id_ticket');
    }
}
