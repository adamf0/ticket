<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chats extends Model
{
    use HasFactory;
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
