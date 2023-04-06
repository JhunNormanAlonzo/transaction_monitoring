<?php

namespace App\Http\Controllers;

use App\Models\ProviderWalletLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ledger(){
//


        $provider_wallet_ledgers = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)->get();
        $cash_in = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->orWhere('status', 'pending')
            ->sum('amount');
        $send_load = $provider_wallet_ledgers->where('status', 'LOADED')->sum('amount');
        $wallet_balance = ProviderWalletLedger::where('access_provider_id', auth()->user()->access_providers->id)
            ->where('status', 'approved')
            ->orWhere('status', 'LOADED')
            ->sum('amount');

        return view('provider.wallet_transaction.ledger', compact(
            ['provider_wallet_ledgers', 'wallet_balance', 'send_load', 'cash_in']
        ));
    }
}
