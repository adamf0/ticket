<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'ticket';
    protected $fillable = ['no_ticket', 'id_user', 'type_ticket','label','judul','deskripsi','foto','id_user_pic','status','status','is_member'];

    public function getIsMemberAttribute($value)
    { 
      return $value;
    }
    public function setIsMemberAttribute($value)
    { 
      $this->attributes['is_member'] = $value;
    }

    public function progress()
    {
        return $this->hasMany(Progress::class,'id_ticket');
    }
    public function pic_member()
    {
        return $this->hasMany(PicMember::class,'id_ticket');
    }
}
