@extends('layouts.main')

@section('title')
    
@endsection
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/tempus.css') }}">
    <script src="{{ asset('assets/js/tempus.js') }}"></script>
@endsection


@section('body')
    @include('layouts.navbar')

   <section class="container">
    <div class="icon ">
        <img src="{{asset('assets/images/PNG/64px/224-happy.png')}}" alt="" class="mx-auto d-block mt-5"> 
    </div>
    <div class="mt-4  text-center">
        <h5>Congratulations, the accommodation has beebn booked for you from DDth of Month to DDth of Month <br>
            We wish you a pleasant stay!</h5>
    </div>
    <div class="mt-3 w-75 mx-auto" style="border: 1px solid black">
        <p>Payment details</p>
        <div class="ps-5">
            <p>Transaction No:</p>
            <p>Property title:</p>
            <p><strong>Total fee:</strong></p>
        </div>

    </div>
   </section>
@endsection
