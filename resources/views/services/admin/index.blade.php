@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        Usługi
                    </h1>
                </div>

                @include('services.partials.list')

            </div>
        </div>
    </section>
@endsection