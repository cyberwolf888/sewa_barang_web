<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    protected $table = 'iklan';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function gambar_iklan()
    {
        return $this->hasMany('App\Models\GambarIklan','iklan_id');
    }

    public function getStatus()
    {
        $status = ['0'=>'Nonaktif','1'=>'Menunggu verfikasi','2'=>'Aktif'];
        return $status[$this->status];
    }
}
