@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        Role \ uprawnienia
                    </h1>

                    <p>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Dodaj</a>
                    </p>

                    <table class="table">
                        <tr>
                            <th>Nazwa</th>
                            <th colspan="3">Akcje</th>
                        </tr>

                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->title }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection