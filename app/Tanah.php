<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    protected $table = 'tanah';

    public function tanah_has_penjual()
    {
        return $this->belongsTo('App\Penjual', 'penjual_id');
    }

    public function tanah_has_foto()
    {
        return $this->hasMany('App\FotoTanah', 'tanah_id', 'id');
    }
}
