<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderWalletLedger extends Model
{

    public $table = "provider_wallet_ledger";

    public function access_providers(){
        return $this->belongsTo(AccessProvider::class, 'access_provider_id', 'id');
    }

}
