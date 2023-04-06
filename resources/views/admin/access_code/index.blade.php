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
                            <x-table>
                                <thead>
                                <x-th>Uploaded</x-th>
                                <x-th>Transaction</x-th>
                                <x-th>Load</x-th>
                                <x-th>Date</x-th>
                                <x-th>Reference</x-th>
                                <x-th>Amount</x-th>
                                <x-th>Approval</x-th>
                                <x-th>Approved</x-th>
                                <x-th>Status</x-th>
                                </thead>
                                <tbody>
                                @foreach($wallet_transactions as $wallet_transaction)
                                    <tr>
                                        <x-td><img width="100" height="100" src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt=""></x-td>
                                        <x-td>{{$wallet_transaction->wallet_transaction_type->trans_description}}</x-td>
                                        <x-td>{{$wallet_transaction->load_type_id ?? 'empty'}}</x-td>
                                        <x-td>{{$wallet_transaction->trans_date}}</x-td>
                                        <x-td>{{$wallet_transaction->trans_reference}}</x-td>
                                        <x-td>{{$wallet_transaction->trans_amount}}</x-td>
                                        <x-td>{{$wallet_transaction->approval_user_id ?? 'empty'}}</x-td>
                                        <x-td>{{$wallet_transaction->approved_at ?? 'empty'}}</x-td>
                                        <x-td>
                                            @if($wallet_transaction->trans_status == 'pending')
                                                <div class="badge bg-warning">
                                                    {{$wallet_transaction->trans_status}}
                                                </div>
                                            @else
                                                <div class="badge bg-success">
                                                    {{$wallet_transaction->trans_status}}
                                                </div>
                                            @endif

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
        document.getElementById('date').flatpickr();


        function wallet_trans_id() {
            var wallet_transaction_type_id = document.getElementById("wallet_transaction_type_id");
            var text = wallet_transaction_type_id.options[wallet_transaction_type_id.selectedIndex].text;
            document.getElementById("wallet_transaction_type_id_view").innerHTML = text;
        }

        function trans_references() {
            var trans_reference = document.getElementById("trans_reference").value;
            document.getElementById("trans_reference_view").innerHTML = trans_reference;
        }

        function trans_amounts() {
            var trans_amount = document.getElementById("trans_amount").value;
            document.getElementById("trans_amount_view").innerHTML = trans_amount;
        }

        function remark() {
            var remarks = document.getElementById("remarks").value;
            document.getElementById("remarks_view").innerHTML = remarks;
        }
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);


                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";

                var preview1 = document.getElementById("file-ip-2-preview");
                preview1.src = src;
                preview1.style.display = "block";

            }
        }


        document.getElementById('table').dataTable();
    </script>

@endsection
