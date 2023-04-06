<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessProvider extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function provider_types(){
        return $this->hasOne(ProviderType::class, 'id', 'provider_type');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
