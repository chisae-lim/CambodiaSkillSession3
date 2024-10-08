@extends('layouts.main')

@section('title')
    Seoul Stay Property Details for "{{ $item->Title }}"
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

    <div class="container mt-3">
        <h1 class="fs-5">Reservation results for <span>...</span> night</h1>
    </div>

    <section class="pb-5 pt-3">
        <div class="container">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-between">
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
            <div class="row gap-0">
                <div class="col-4">
                    <div class="d-flex gap-3">
                        <p class="fs-6">Capactiy <span>{{ $item->Capacity }}</span></p>
                        <p class="fs-6">Bedrooms <span>{{ $item->NumberOfBedrooms }}</span></p>
                        <p class="fs-6">Beds <span>{{ $item->NumberOfBeds }}</span></p>
                        <p class="fs-6">Bathrooms <span>{{ $item->NumberOfBathrooms }}</span></p>
                    </div>
                    <h1 class="fs-5">Description</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi molestias officia, iusto tenetur
                        accusantium ullam, exercitationem voluptatibus odit eum vitae ipsam recusandae et quaerat vero sunt
                        maiores, necessitatibus odio nesciunt.</p>

                    <h1 class="fs-5">Host rules</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi molestias officia, iusto tenetur
                        accusantium ullam, exercitationem voluptatibus odit eum vitae ipsam recusandae et quaerat vero sunt
                        maiores, necessitatibus odio nesciunt.</p>
                </div>
                <div class="col-4">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <div class="">
                                <p>Available Amenties</p>

                                @foreach ($item->item_amenities as $item_amenity)
                                    <p> <img class="" width="20"
                                            src="{{ asset('assets/images/png/16px/'.$item_amenity->amenity->IconName) }}" alt="">
                                        {{ $item_amenity->amenity->Name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-end gap-3">
                    <div class="text-end">
                        <p>check-in <span>dd/mm/yyyy</span></p>
                        <p>check-out <span>dd/mm/yyyy</span></p>
                        <div class="" style="width: 50px d-flex">
                            Reservation for
                            <input type="number" name="numeric" id="numeric">
                            ppl
                        </div>
                        <p class="text-center">Payable Amount 90 USD</p>
                        <div class="w-100 px-5">
                            <a href="" class="w-100 btn btn-outline-primary">Reserve now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
