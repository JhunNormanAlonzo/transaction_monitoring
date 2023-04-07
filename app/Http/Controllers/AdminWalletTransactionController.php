<?php

namespace App\Http\Controllers;


use App\Models\AccessProvider;
use App\Models\LoadType;
use App\Models\ProviderType;
use App\Models\WalletTransaction;
use App\Models\WalletTransactionAttachment;
use App\Models\WalletTransactionType;
use Illuminate\Http\Request;

class AdminWalletTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet_transactions = WalletTransaction::where('load_type_id', null)
            ->latest()
            ->get();
        return view('admin.wallet_transaction.index', compact('wallet_transactions'));

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

        $access_providers = AccessProvider::all();
        $credit_lists = LoadType::all();

        return view('admin.wallet_transaction.create', compact('wallet_transaction_types', 'access_providers', 'credit_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $load_credits = LoadType::pluck('load_credits')->toArray();


        $this->validate($request, [
            'access_provider_id' => 'required',
            'wallet_transaction_type_id' => 'required',
            'trans_reference' => 'required',
            'trans_amount' => 'required|in:'.implode(',', $load_credits),
            'remarks' => 'required',
            'user_id' => 'required',
            'attachment' => 'required|file|mimes:jpeg,jpg,png,pdf,doc,docx|max:204800',
        ], [
            'trans_amount.in' => 'The amount must be one of load credits.',
        ]);

        $access_provider_id = AccessProvider::where('account_name', $request->access_provider_id)->pluck('id')->first();
        $waltran = [
            'access_provider_id' => $access_provider_id,
            'wallet_transaction_type_id' => $request->wallet_transaction_type_id,
            'trans_reference' => $request->trans_reference,
            'trans_amount' => $request->trans_amount,
            'remarks' => $request->remarks,
            'user_id' => $request->user_id,
            'approval_user_id' => auth()->user()->id,
            'approved_at' => now()->toDateTimeString(),
            'trans_status' => 'approved',
            'approval_comment' => 'direct request',
            'approval_tag' => 1
        ];

        $wallet_transaction = WalletTransaction::create($waltran);

        $attachment = $request->attachment->hashName();
        $request->attachment->move(storage_path('app/public/wallet_attachments'), $attachment);

        $walattach = [
            'wallet_transaction_id' => $wallet_transaction->id,
            'attachment' => $attachment,
        ];
        WalletTransactionAttachment::create($walattach);
        $wallet_transaction_type_id = WalletTransactionType::where('trans_description', 'CM - REBATES')->pluck('id')->first();
        $load_type = LoadType::where('load_credits', $wallet_transaction->trans_amount);
        $load_type_id = $load_type->pluck('id')->first();
        $load_credits = $load_type->pluck('load_credits')->first();
        $rebate = $load_type->pluck('rebate')->first();
        $amount_rebate = $load_credits * $rebate;
        $to_rebate = [
            'access_provider_id' => $wallet_transaction->access_provider_id,
            'wallet_transaction_type_id' => $wallet_transaction_type_id,
            'trans_reference' => 'REBATE-'.$wallet_transaction->trans_reference,
            'load_type_id' => $load_type_id,
            'trans_amount' => $amount_rebate,
            'approval_user_id' => auth()->user()->id,
            'approved_at' => now()->toDateTimeString(),
            'remarks' => 'rebate success',
            'trans_status' => 'rebate',
            'approval_tag' => 1,
            'user_id' => auth()->user()->id,
        ];


        WalletTransaction::create($to_rebate);
        return redirect()->back()->with('message', 'Request Sent successfully! ');
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
