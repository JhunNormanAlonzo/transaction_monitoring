<?php

namespace App\Http\Livewire;

use App\Models\ProviderWalletLedger;
use Carbon\Carbon;
use Livewire\Component;

class CashIn extends Component
{
    public $cash_in;
    public $filter;
    public $filterTag = "All";

    public function all(){
        $this->filter = Carbon::parse(Carbon::now());

        $this->cash_in = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->orWhere('status', 'pending')
            ->sum('amount');

        $this->filterTag = "All";
    }

    public function today(){
        $this->filter = Carbon::now()->format('Y-m-d');

        $this->cash_in =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->orWhere('status', 'pending')
            ->sum('amount');

        $this->filterTag = "Today";
    }

    public function month(){
        $this->filter = Carbon::now()->format('Y-m');

        $this->cash_in =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->orWhere('status', 'pending')
            ->sum('amount');

        $this->filterTag = "Month";
    }

    public function year(){
        $this->filter = Carbon::now()->format('Y');

        $this->cash_in =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->orWhere('status', 'pending')
            ->sum('amount');

        $this->filterTag = "Year";
    }

    public function mount(){
        $this->cash_in = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->orWhere('status', 'pending')
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.cash-in', [
            'cash_in' => $this->cash_in
        ]);
    }
}
