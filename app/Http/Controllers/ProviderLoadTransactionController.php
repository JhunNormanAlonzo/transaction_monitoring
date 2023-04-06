<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use App\Models\LoadType;
use App\Models\WalletTransaction;
use App\Models\WalletTransactionType;
use Illuminate\Http\Request;

class ProviderLoadTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access_code = AccessCode::where('loaded_user_id', auth()->user()->id)->latest('updated_at', 'desc')->first();
        $wallet_transaction = $access_code->wallet_transaction;
        return view('provider.load_transaction.index', compact(['access_code', 'wallet_transaction']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $load_types = LoadType::all();
        $wallet_transaction_types = WalletTransactionType::where('ewalletrans', '0')
            ->where('providertag', '1')->paginate(10);
        return view('provider.load_transaction.create', compact(['load_types', 'wallet_transaction_types']));
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
            'wallet_transaction_type_id' => 'required',
            'load_type_id' => 'required',
            'trans_cpnumber' => 'required|min:11|max:11',
        ]);

        $access_code = AccessCode::where('loaded_at', '=', null)
            ->where('load_type_id', '=', $request->load_type_id)
            ->take(1)->pluck('voucher_code')->first();


        if (!$access_code){
            return redirect()->back()->with('warning', 'Sorry! no available load for this request,  please select other option thank you!');
        }else {
            date_default_timezone_set('Asia/Manila');
            $trans_amount = LoadType::where('id', $request->load_type_id)->pluck('load_credits')->first();
            $date = date("YmdHis");


            $wal = WalletTransaction::create([
                'access_provider_id' => auth()->user()->access_providers->id,
                'wallet_transaction_type_id' => $request->wallet_transaction_type_id,
                'load_type_id' => $request->load_type_id,
                'trans_reference' => '0',
                'trans_amount' => $trans_amount,
                'trans_cpnumber' => $request->trans_cpnumber,
                'user_id' => auth()->user()->id,
                'trans_status' => 'LOADED'
            ]);

            $walData = [
                'trans_reference' => $wal->id . $date . auth()->user()->access_providers->id
            ];

            $wal->update($walData);

            $ac = AccessCode::where('voucher_code', '=', $access_code);
            $data = [
                'wallet_transaction_id' => $wal->id,
                'loaded_at' => now()->toDateTimeString(),
                'loaded_user_id' => auth()->user()->id,
                'status' => 'loaded'
            ];
            $ac->update($data);


            return redirect()->route("provider_load_transactions.index");
        }
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
