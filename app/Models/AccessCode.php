<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function wallet_transaction(){
        return $this->hasOne(WalletTransaction::class, 'id', 'wallet_transaction_id');
    }

    public function load_types(){
        return $this->hasOne(LoadType::class, 'id', 'load_type_id');
    }

    public function users(){
        return $this->hasOne(User::class, 'id', 'loaded_user_id');
    }
}
