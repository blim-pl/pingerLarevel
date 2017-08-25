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

                    <table class="table table-striped">
                        <tr>
                            <th>Nazwa</th>
                            <th>Dostęp</th>
                            <th colspan="2" class="text-center">Akcje</th>
                        </tr>

                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->title }}
                                </td>
                                <td>
                                    {{ $role->access }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.roles.destroy', $role->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection