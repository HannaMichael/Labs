<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $dateFormat = 'U';

    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
    //
}
