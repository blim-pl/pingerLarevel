@extends('admin.layouts.master')


@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Edycja danych</h1>

                    @include('admin.layouts.partials.forms.errors')

                    <form method="post" action="{{ route('admin.users.update', $user) }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <label>Imię</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" />
                        </div>

                        <div class="form-group">
                            <label>E-mail/Login</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required="email" />
                        </div>

                        <div class="form-group">
                            <label>Nowe hasło</label>
                            <input type="password" class="form-control" name="password" />
                        </div>

                        <div class="form-group">
                            <label>Powtórz nowe hasło</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                Zapisz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection