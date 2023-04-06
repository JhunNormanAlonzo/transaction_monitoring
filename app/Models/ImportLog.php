<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function access_codes(){
        return $this->hasMany(AccessCode::class);
    }

    public function wifi_site(){
        return $this->hasOne(WifiSite::class, 'id', 'wifi_site_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
