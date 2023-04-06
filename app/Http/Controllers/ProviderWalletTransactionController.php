<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use App\Models\WalletTransactionAttachment;
use App\Models\WalletTransactionType;
use Illuminate\Http\Request;

class ProviderWalletTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $wallet_transactions = WalletTransaction::where('user_id', $user_id)
            ->where('load_type_id', null)
            ->latest()->get();


        return view('provider.wallet_transaction.index', compact('wallet_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wallet_transaction_types = WalletTransactionType::where('ewalletrans', '1')
            ->where('providertag', '1')->get();
        return view('provider.wallet_transaction.create', compact('wallet_transaction_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'access_provider_id' => 'required',
            'wallet_transaction_type_id' => 'required',
            'trans_reference' => 'required',
            'trans_amount' => 'required',
            'remarks' => 'required',
            'user_id' => 'required',
            'attachment' => 'required|file|mimes:jpeg,jpg,png,pdf,doc,docx|max:204800',
        ]);

        $waltran = [
            'access_provider_id' => $request->access_provider_id,
            'wallet_transaction_type_id' => $request->wallet_transaction_type_id,
            'trans_reference' => $request->trans_reference,
            'trans_amount' => $request->trans_amount,
            'remarks' => $request->remarks,
            'user_id' => $request->user_id,
        ];

        $wallet_transaction = WalletTransaction::create($waltran);


        $attachment = $request->attachment->hashName();
        $request->attachment->move(storage_path('app/public/wallet_attachments'), $attachment);

        $walattach = [
            'wallet_transaction_id' => $wallet_transaction->id,
            'attachment' => $attachment,
        ];
        WalletTransactionAttachment::create($walattach);


        return redirect()->back()->with('message', 'Wallet Transaction Created Successfully');
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
}
