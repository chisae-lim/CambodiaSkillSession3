@extends('layouts.main')

@section('title')
    Seoul Stay Property Details {{ $item ? 'for ' . $item->Title : '' }}
@endsection

<style>
    img {
        max-width: 290px;
        max-height: 210px;
        padding-right: 5px;
    }
</style>
@section('body')
    @include('layouts.navbar')
    @if (!$item)
        <h1 class="text-center">Item not Available.</h1>
    @else
        <div class="container mt-3">
            <h1 class="fs-5">Details of "{{ $item->Title }}" at {{ $item->area->Name }}</h1>
        </div>

        <section class="pb-5 pt-3">
            <div class="container">
                <div class="row justify-content-between">
                    @if (count($item->pictures) === 0)
                        <div class="col-3">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('assets/images/itemPictures/default.jpg') }}" />
                            </div>
                        </div>
                    @else
                        @foreach ($item->pictures as $img)
                            <div class="col-3">
                                <div class="card p-0">
                                    <img src="{{ asset('assets/images/itemPictures/' . $img->PictureFileName) }}" />
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="d-flex">
                            <p class="fs-6">Capactiy <span>{{ $item->Capacity }}</span></p>
                            <p class="fs-6">Bedrooms <span>{{ $item->NumberOfBedrooms }}</span></p>
                            <p class="fs-6">Beds <span>{{ $item->NumberOfBeds }}</span></p>
                            <p class="fs-6">Bathrooms <span>{{ $item->NumberOfBathrooms }}</span></p>
                        </div>
                        <h1 class="fs-5">Description</h1>
                        <p>{{ $item->Description }}</p>

                        <h1 class="fs-5">Host rules</h1>
                        <p>{{ $item->HostRules }}</p>
                    </div>
                    <div class="col">
                        <div class="">
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    <p>Available Amenties</p>

                                    @foreach ($item->item_amenities as $item_amenity)
                                        <p> <img class="" width="20"
                                                src="{{ asset('assets/images/png/16px/' . $item_amenity->amenity->IconName) }}"
                                                alt="">
                                            {{ $item_amenity->amenity->Name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <p>check-in <span>{{ \Carbon\Carbon::parse($from_date)->format('d/m/Y') }}</span></p>
                        <p>check-out
                            <span>{{ \Carbon\Carbon::parse($from_date)->addDays(intval($duration))->format('d/m/Y') }}</span>
                        </p>
                        <p class="d-flex justify-content-start">
                            <span class="my-auto"> Reserve for</span>
                            <input type="number" class="form-control w-25 mx-1" step="1" value="1"
                                min="1" max="{{ $item->Capacity }}">
                            <span class="my-auto"> ppl</span>

                        </p>
                        <h5>Payable Amount {{ $item->current_price->Price * $duration }} USD</h5>
                        <button class="btn btn-outline-primary w-100">Reserve now</a>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#search-input').val('{{ $item ? $item->area->Name : '' }}').prop('disabled', true);
        });
    </script>
@endsection
