<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoTanah extends Model
{
    protected $table = 'foto_tanah';

    public function foto_has_tanah()
    {
        return $this->belongsTo('App\Tanah');
    }
}
