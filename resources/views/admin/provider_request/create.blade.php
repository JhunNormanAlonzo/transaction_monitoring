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
                        <div class="card-header">{{ __('Wallet Transaction') }}</div>

                        <div class="card-body">
                            <form action="{{route('wallet_transactions.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Transaction Type</label>
                                            <select  onchange="wallet_trans_id()" name="wallet_transaction_type_id" id="wallet_transaction_type_id" class="form-control form-control-sm @error('wallet_transaction_type_id') is-invalid @enderror">
                                                <option value="">Choose transaction...</option>
                                                @foreach(\App\Models\WalletTransactionType::all() as $wallet_transaction)
                                                    <option value="{{$wallet_transaction->id}}">{{ucwords($wallet_transaction->trans_description)}}</option>
                                                @endforeach
                                            </select>

                                            @error('wallet_transaction_type_id')
                                            <span class="invalid-feedback">
                                            {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Transaction Reference </label>
                                            <input onkeyup="trans_references()" id="trans_reference" name="trans_reference" type="text"  class="form-control-sm form-control @error('trans_reference') is-invalid @enderror">

                                            @error('trans_reference')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Transaction Amount </label>
                                            <input onkeyup="trans_amounts()" id="trans_amount" name="trans_amount" type="number"  class="form-control-sm form-control @error('trans_amount') is-invalid @enderror">
                                            @error('trans_amount')
                                            <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Remarks</label>
                                            <textarea onkeyup="remark()" name="remarks" id="remarks"  class="form-control-sm form-control @error('remarks') is-invalid @enderror" rows="3"></textarea>
                                            @error('remarks')
                                            <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Attachment</label>
                                            <input type="file" name="attachment" accept="image/*" class="form-control form-control-sm @error('attachment') is-invalid @enderror " onchange="showPreview(event)">
                                            @error('attachment')
                                            <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <img class="w-100" id="file-ip-1-preview">
                                        </div>
                                    </div>
                                    <input name="user_id" type="text" hidden value="{{auth()->user()->id}}">

                                    <input name="access_provider_id" type="text" hidden value="{{auth()->user()->access_provider->id}}">

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#preview" class="btn btn-sm btn-primary">Submit</button>
                                            <div class="modal fade" id="preview">
                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmation</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-12">
                                                                    <div class="mb-3">
                                                                        <label for="">Transaction Type</label>
                                                                        <div>
                                                                            <b id="wallet_transaction_type_id_view" ></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-12">
                                                                    <div class="mb-3">
                                                                        <label for="">Transaction Reference </label>
                                                                        <div>
                                                                            <b id="trans_reference_view" ></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-12">
                                                                    <div class="mb-3">
                                                                        <label for="">Transaction Amount </label>
                                                                        <div>
                                                                            <b id="trans_amount_view" ></b>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 col-12">
                                                                    <div class="mb-3">
                                                                        <label for="">Remarks</label>
                                                                        <div>
                                                                            <b id="remarks_view" ></b>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label for="">Selected Picture</label>
                                                                        <img class="w-100" id="file-ip-2-preview">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                                                            <button class="btn btn-primary" type="submit">Confirm Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    </script>

@endsection
