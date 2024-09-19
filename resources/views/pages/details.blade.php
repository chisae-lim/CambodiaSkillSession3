@extends('main')

@section('title')
    Seoul Stay Property Details for "property title"
@endsection

@section('body')
    @include('layout.navbar')

    <div class="container mt-3">
        <h1 class="fs-5">Reservation results for <span>...</span> night</h1>
    </div>

    <section class="pb-5 pt-3">
        <div class="container">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-between">
                @php
                    $a = 3;
                @endphp
                @for ($i = 0; $i < $a; $i++)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('asset/itemPictures/default.jpg') }}" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-start">
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <div class="d-flex gap-5">
                                        <div class="">
                                            <span>Area</span>
                                            <span>1</span>
                                        </div>
                                        <div class="">
                                            <span>1</span>
                                            <span>people</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        total price $<span>90</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="row gap-0">
                <div class="col-4">
                    <div class="d-flex gap-3">
                        <p class="fs-6">Capactiy <span>2</span></p>
                        <p class="fs-6">Bedrooms <span>2</span></p>
                        <p class="fs-6">Beds <span>2</span></p>
                        <p class="fs-6">Bathrooms <span>2</span></p>
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
                                <p> <img class="" width="20" src="{{ asset('asset/48px/028-connection.png') }}"
                                        alt=""> WIFI</p>
                                <p> <img class="" width="20" src="{{ asset('asset/48px/087-display.png') }}"
                                        alt=""> TV - DVD</p>
                                <p> <img class="" width="20" src="{{ asset('asset/48px/096-box-remove.png') }}"
                                        alt=""> Bathroom</p>
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
