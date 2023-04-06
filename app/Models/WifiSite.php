<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiSite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function areas(){
        return $this->hasOne(Area::class, 'id', 'area_id');
    }
}
