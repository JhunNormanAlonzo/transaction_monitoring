<?php

namespace App\Http\Livewire;

use App\Models\ProviderWalletLedger;
use Carbon\Carbon;
use Livewire\Component;

class Rebate extends Component
{
    public $rebate;
    public $filter;
    public $filterTag = "All";

    public function all(){
        $this->filter = Carbon::parse(Carbon::now());

        $this->rebate = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'rebate')
            ->sum('amount');

        $this->filterTag = "All";
    }

    public function today(){
        $this->filter = Carbon::now()->format('Y-m-d');

        $this->rebate =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'rebate')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Today";
    }

    public function month(){
        $this->filter = Carbon::now()->format('Y-m');

        $this->rebate =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'rebate')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Month";
    }

    public function year(){
        $this->filter = Carbon::now()->format('Y');

        $this->rebate =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'rebate')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Year";
    }

    public function mount(){
        $this->rebate = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'rebate')
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.rebate', [
            'rebate' => $this->rebate
        ]);
    }
}
