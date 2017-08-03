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
                    <table class="table table-striped">
                        <tr>
                            <th>Nazwa</th>
                            <th>Url</th>
                            <th>Aktywna</th>
                            <th colspan="3" class="text-center">Akcje</th>
                        </tr>
                        @foreach ($services as $service)
                        <tr>
                            <td>
                                <a href="/services/{{ $service->id }}">
                                {{ $service->title }}
                                </a>
                            </td>
                            <td>
                                {{ $service->url }}
                            </td>
                            <td>
                                @if ($service->is_active)
                                    <span class="glyphicon glyphicon-ok"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove"></span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/services/{{ $service->id }}/edit" class="btn btn-primary">Edytuj</a>
                            </td>
                            <td class="text-center">
                                <a href="/checks/{{ $service->id }}" class="btn btn-success">Dajesz</a>
                            </td>
                            <td class="text-center">
                                <form method="post" action="/services/{{ $service->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}

                                    <button class="btn btn-danger" type="submit">Usuń</button>
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