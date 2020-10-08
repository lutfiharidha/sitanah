<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $table = 'penjual';
    public function penjual_has_user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
