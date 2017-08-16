@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Edycja wpisu</h1>

                    <form method="post" action="{{ route('admin.roles.update', $role) }}">

                        @include('admin.layouts.partials.forms.errors')

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="title">
                                Nazwa
                            </label>
                            <input name="title" value="{{ old('title', $role->title) }}" class="form-control" />
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