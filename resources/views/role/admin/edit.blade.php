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
                            <input name="title" value="{{ old('title', $role->title) }}" class="form-control" placeholder="Etykieta" />
                        </div>

                        <div class="form-group">
                            <label for="access">Dostęp</label>
                            <input type="text" value="{{ old('access', $role->access) }}" name="access" class="form-control" placeholder="akcje po przecinku" />
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