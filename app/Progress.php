<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    public function tickets()
    {
        return $this->belongsTo(Tickets::class,'id');
    }
}
