@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        Nowa rola
                    </h1>

                    <form method="post" action="{{ route('admin.roles.store') }}">

                        @include('admin.layouts.partials.forms.errors')

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Nazwa</label>
                            <input type="text" class="form-control" name="title" required value="{{ old('title') }}" />
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection