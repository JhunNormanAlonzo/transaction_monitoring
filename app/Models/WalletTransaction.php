<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function access_providers(){
        return $this->belongsTo(AccessProvider::class, 'access_provider_id', 'id');
    }



    public function wallet_transaction_type(){
        return $this->belongsTo(WalletTransactionType::class, 'wallet_transaction_type_id', 'id');
    }

    public function wallet_transaction_attachment(){
        return $this->hasOne(WalletTransactionAttachment::class, 'wallet_transaction_id', 'id');
    }

    public function approver(){
        return $this->belongsTo(User::class, 'approval_user_id', 'id');
    }


}
