@extends('layouts.main')

@section('title')
    Seoul Stay-Payment Processing
@endsection

@section('body')
    @include('layouts.navbar')
    <div class="container">
        <div class="row px-5 py-3">
            <div class="col-8 pe-5">
                <form
                    action="{{ '/booking/create/item/' . $item->GUID . '/date/' . $from_date . '/duration/' . $duration . '/ppl/' . $ppl }}"
                    method="post">
                    @csrf
                    <div class="row row-gap-5 justify-content-center">
                        <div class="col-12 d-flex">
                            <label class="w-25">Card number</label>
                            <input type="text" name="" id="" class=" w-100 form-control">
                        </div>
                        <div class="col-4 d-flex">
                            <label class="w-100">CVC</label>
                            <input type="text" class="w-50 form-control">
                        </div>
                        <div class="col-4 d-flex">
                            <label class="w-25">MM</label>
                            <input type="text" class=" w-50 form-control">
                        </div>
                        <div class="col-4 d-flex">
                            <label class="w-25">YY</label>
                            <input type="text" class=" w-50 form-control">
                        </div>
                        <div class="col-12 d-flex">
                            <label class="w-25">Password</label>
                            <input type="text" class=" w-100 form-control">
                        </div>
                        <div class="row justify-content-end column-gap-5">
                            <button class="btn btn-primary w-25" type="submit">Pay Now
                                <span>(${{ $item->total }})</span></button>
                            <a class="btn btn-secondary w-25" href="{{ url()->previous() }}" type="button">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-auto ps-5" style="border-left: 1px solid black;">
                <div class="d-flex gap-2">
                    <h6>Payment Detail</h6>
                    <span>...</span>
                </div>
                <div class="d-flex gap-2">
                    <h6>Fee:</h6>
                    <span>...</span>
                </div>
                <div class="d-flex gap-2">
                    <h6>Transactioin ID:</h6>
                    <span>...</span>
                </div>
                <div class="d-flex gap-2">
                    <h6>Sale Description</h6>
                    <span>...</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#search-input').val('{{ $item ? $item->area->Name : '' }}').prop('disabled', true);
        });
    </script>
@endsection
