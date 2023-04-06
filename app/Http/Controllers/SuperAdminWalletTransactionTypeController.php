<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use App\Models\WalletTransactionType;
use Illuminate\Http\Request;

class SuperAdminWalletTransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet_transaction_types = WalletTransactionType::latest()->get();
        return view('superadmin.wallet_transaction_type.index', compact('wallet_transaction_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.wallet_transaction_type.create');
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
           'trans_description' => 'required|unique:wallet_transaction_types',
            'trans_type' => 'required',
            'approval' => 'required',
            'ewalletrans' => 'required',
            'providertag' => 'required'
        ]);


        WalletTransactionType::create($request->all());
        return redirect()->route('superadmin_transaction_types.index')->with('message', 'Wallet Transaction Type Created Successfully!');
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
        $wallet_transaction_type = WalletTransactionType::find($id);
        return view('superadmin.wallet_transaction_type.edit', compact('wallet_transaction_type'));
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

        $wallet_transaction_type = WalletTransactionType::find($id);

        $this->validate($request, [
            'trans_description' => 'required|unique:wallet_transaction_types,trans_description,'.$id,
            'trans_type' => 'required',
            'approval' => 'required',
            'ewalletrans' => 'required',
            'providertag' => 'required'
        ]);

        $wallet_transaction_type->update($request->all());
        return redirect()->route('superadmin_transaction_types.index')->with('message', 'Wallet Transaction Type Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wallet_transaction_type = WalletTransactionType::find($id);

        if (WalletTransaction::where('wallet_transaction_type_id', $id)->count() > 0){
            return redirect()->route('superadmin_transaction_types.index')->with('message', 'Unable to delete. This transaction has been used by other table!');
        }else{
            $wallet_transaction_type->delete($id);
            return redirect()->route('superadmin_transaction_types.index')->with('message', 'Wallet Transaction Type Deleted Successfully!');

        }

    }
}
