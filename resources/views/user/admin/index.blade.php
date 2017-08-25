@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        Użytkownicy
                    </h1>
                    <table class="table table-striped">
                        <tr>
                            <th>Email</th>
                            <th>Imię</th>
                            <th class="text-center" colspan="2">Akcje</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}

                                        <button class="btn btn-danger" type="submit">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection