<?php

namespace App\Http\Livewire;

use App\Models\ProviderWalletLedger;
use Carbon\Carbon;
use Livewire\Component;

class SendLoad extends Component
{
    public $send_load;
    public $filter;
    public $filterTag = "All";

    public function all(){
        $this->filter = Carbon::parse(Carbon::now());

        $this->send_load = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'LOADED')
            ->sum('amount');

        $this->filterTag = "All";
    }

    public function today(){
        $this->filter = Carbon::now()->format('Y-m-d');

        $this->send_load =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'LOADED')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Today";
    }

    public function month(){
        $this->filter = Carbon::now()->format('Y-m');

        $this->send_load =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'LOADED')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Month";
    }

    public function year(){
        $this->filter = Carbon::now()->format('Y');

        $this->send_load =  ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'LOADED')
            ->where('trans_date', 'like', '%'.$this->filter.'%')
            ->sum('amount');

        $this->filterTag = "Year";
    }

    public function mount(){
        $this->send_load = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'LOADED')
            ->sum('amount');
    }
    public function render()
    {
        return view('livewire.send-load', [
            'send_load' => $this->send_load
        ]);
    }
}
