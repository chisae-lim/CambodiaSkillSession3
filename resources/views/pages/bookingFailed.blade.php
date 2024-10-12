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
        <img src="{{asset('assets/images/PNG/64px/230-sad.png')}}" alt="" class="mx-auto d-block mt-5"> 
    </div>
    <div class="mt-4  text-center">
        <h5>Unfortunatly, your payment was not successful</h5>
    </div>
    <div class="mt-3 w-75 mx-auto" style="border: 1px solid black">
        <p>The reason for the transaction error <br><br><br><br></p>
        {{-- <div class="ps-5">
            <p> </p>
            <p> </p>
            <p><strong> </strong></p>
        </div> --}}

    </div>
   </section>
@endsection
