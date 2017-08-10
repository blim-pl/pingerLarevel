@extends('layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Twoje usługi</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('services.partials.list')
                </div>
            </div>
        </div>
    </section>
@endsection