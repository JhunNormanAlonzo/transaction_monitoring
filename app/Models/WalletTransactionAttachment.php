<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransactionAttachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function wallet_transaction(){
        return $this->belongsTo(WalletTransaction::class, 'wallet_transaction_id', 'id');
    }
}
