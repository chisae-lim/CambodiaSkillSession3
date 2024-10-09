@extends('layouts.main')

@section('title')
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/tempus.css') }}">
    <script src="{{ asset('assets/js/tempus.js') }}"></script>
@endsection
@section('body')
    @include('layouts.navbar')

    <div class="container mt-3">
        <div class="row">
            <h6 class="col" id="header-label"></h6>

            <div class="col-auto d-flex justify-content-end">
                <label class="my-auto mx-3">Date: </label>
                <div class="input-group date w-25" id="date_input" data-target-input="nearest">
                    <input v-model="model" class="form-control datetimepicker-input" data-target="#date_input">
                    <div class="input-group-append" data-target="#date_input" data-toggle="datetimepicker">
                        <div class="input-group-text"><i><img src="{{ asset('assets/icons/084-calendar.png') }}"
                                    style="width:25px"></i></div>
                    </div>
                </div>
                <label class="my-auto mx-3">Duration: </label>
                <input id="duration_input" class="form-control w-25" type="number" value="1">
                <label class="my-auto mx-3">Day(s) </label>

            </div>
        </div>
    </div>

    <section class="pt-3">
        <div class="container">
            <div class="row" id="item-container">

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#search-input').val('Seocho-gu');
            $('#date_input').datetimepicker({
                format: 'DD/MM/YYYY',
            });
            $('#date_input').datetimepicker('defaultDate', moment('25/11/2022', 'DD/MM/YYYY'));


            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                fetchResults();
            });
            $('#duration_input').on('change', function(e) {
                e.preventDefault();
                fetchResults();
            });
            $('#date_input').on('change.datetimepicker', function(e) {
                e.preventDefault();
                fetchResults();
            });
            fetchResults();
        });

        async function fetchResults() {
            const area_name = $('#search-input').val();
            const date = moment($("#date_input").data("datetimepicker").date()).format('DD-MM-YYYY');
            const duration = $('#duration_input').val();
            try {
                const res = await axios.get('/api/search/items/', {
                    params: {
                        area_name: area_name,
                        from_date: date, // 'DD-MM-YYYY'
                        duration: duration,
                    }
                });
                const items = res.data;
                $('#item-container').empty();
                items.forEach(({
                    ID,
                    Title,
                    Capacity,
                    pictures,
                    area,
                    current_price
                }) => { // object destructuring

                    $('#item-container').append(
                        '<div class="col-3 mb-5">' +
                        '<a href="/items/detail/' + ID + '/date/' + date + '/duration/' +
                        duration + '">' +

                        '<div class="card h-100">' +
                        '<img class="card-img-top border border-secondary"' +
                        'src="' + (pictures.length === 0 ? "assets/images/itemPictures/default.jpg" :
                            "assets/images/itemPictures/" + pictures[0].PictureFileName) +
                        '" alt="..." />' +
                        '<div class="card-body p-4">' +
                        '<div class="text-start">' +
                        '<h5 class="fw-bolder">' + Title + '</h5>' +
                        '<div class="d-flex gap-5">' +
                        '<div>' +
                        '<span>' + area.Name + '</span>' +
                        '</div>' +
                        '<div>' +
                        '<span>' + Capacity + '</span>' +
                        '<span> people</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="">' +
                        'total price $<span>' + current_price.Price + '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</a>' +

                        '</div>'
                    )
                });
                if (items.length === 0 || area_name === '') {
                    $('title').html('Seoul stay-Reservation Results')
                    $('#header-label').html('Reservation results from ' +
                        date + ' for ' + duration + ' night');
                } else {
                    $('title').html('Seoul stay-Reservation Results For ' + area_name)
                    $('#header-label').html('Reservation results for "' + area_name + '" from ' +
                        date + ' for ' + duration + ' night');
                }
            } catch (error) {
                window.location.reload();
            }
        }
    </script>
@endsection
