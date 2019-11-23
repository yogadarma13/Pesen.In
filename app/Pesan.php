<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'nomor';

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'id_user');
    }
}
