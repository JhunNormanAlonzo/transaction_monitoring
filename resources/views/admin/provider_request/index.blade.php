@extends('admin.layouts.master')
@section('content')
    <main id="main" class="main justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session('message') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">{{ __('Wallet Transaction Logs') }}</div>

                        <div class="card-body">
                            <x-table  >
                                <thead>
                                <x-th>RequestorName</x-th>
                                <x-th>AccountName</x-th>
                                <x-th>TransactionType</x-th>
                                <x-th>Load</x-th>
                                <x-th>TransactionDate</x-th>
                                <x-th>Reference</x-th>
                                <x-th>Amount</x-th>
                                <x-th>Approval</x-th>
                                <x-th>Approved</x-th>
                                <x-th>Status</x-th>
                                <x-th>Approve</x-th>
                                </thead>
                                <tbody>
                                @foreach($provider_requests as $pr)
                                    <tr>
                                        <x-td>{{$pr->user->name}}</x-td>
                                        <x-td>{{$pr->access_provider->account_name}}</x-td>
                                        <x-td>{{$pr->wallet_transaction_type->trans_description}}</x-td>
                                        <x-td>{{$pr->load_type_id ?? 'empty'}}</x-td>
                                        <x-td>
                                            {{\Carbon\Carbon::parse($pr->trans_date)->format('F j, Y')}} <br>
                                            {{\Carbon\Carbon::parse($pr->trans_date)->format('h:m i a')}}
                                        </x-td>
                                        <x-td>{{$pr->trans_reference}}</x-td>
                                        <x-td><i class="bi bi-currency-dollar"></i> {{$pr->trans_amount}}</x-td>
                                        <x-td>{{$pr->approval_user_id ?? 'empty'}}</x-td>
                                        <x-td>{{$pr->approved_at ?? 'empty'}}</x-td>
                                        <x-td>
                                            @if($pr->trans_status == 'pending')
                                                <div class="badge bg-warning">
                                                    {{$pr->trans_status}}
                                                </div>
                                            @else
                                                <div class="badge bg-success">
                                                    {{$pr->trans_status}}
                                                </div>
                                            @endif

                                        </x-td>
                                        <x-td>
                                            <button class="btn btn-sm">action</button>
                                        </x-td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </x-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        $(document).ready(function (){
            $("#datatable").DataTable();
        });
    </script>


@endsection
