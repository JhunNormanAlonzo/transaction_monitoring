<?php

namespace App\Http\Livewire;

use App\Models\ProviderWalletLedger;
use Carbon\Carbon;
use Livewire\Component;

class WalletBalance extends Component
{

    public $filter;
    public $filterTag = "Today";
    public $wallet_balance;

    public function today(){
        $this->filter = Carbon::parse(Carbon::now());
        $this->filterTag = "Today";
        $this->wallet_balance = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->orWhere('status', 'LOADED')
            ->sum('amount');
    }

    public function mount(){
        $this->wallet_balance = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->orWhere('status', 'LOADED')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.wallet-balance', [
            'wallet_balance' =>  $this->wallet_balance
        ]);
    }
}

