<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chats extends Model
{
    protected $table = 'chat';

    public function Tickets()
    {
        return $this->belongsTo(Tickets::class,'id');
    }
    public function getToNameAttribute($value)
    {
        return DB::table('user')->where('id',$this->to_user)->first();
    }
    public function getFromNameAttribute($value)
    {
        return DB::table('user')->where('id',$this->from_user)->first();
    }
}
