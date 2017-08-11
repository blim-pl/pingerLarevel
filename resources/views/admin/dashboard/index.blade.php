@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Ostatnio modyfikowane aktywności</strong>
                    </p>
                    <table class="table">
                        <tr>
                            <th>Nazwa</th>
                            <th>Użytkownik</th>
                            <th>Ostatnia mod.</th>
                        </tr>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <a href="{{ route('admin.services.show', $service) }}">{{ $service->title }}</a>
                            </td>
                            <td>
                                {{ $service->user->name }}
                            </td>
                            <td>
                                {{ $service->updated_at }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <p>
                        <strong>Ostatnie logi</strong>
                    </p>
                    <table class="table">
                        <th>
                            Data utw.
                        </th>
                        <th>
                            Usługa
                        </th>
                        <th>
                            Dane
                        </th>
                        @foreach ($logs as $log)
                            <tr>
                                <td>
                                    {{ $log->created_at }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.show', $log->service_id) }}">{{ $log->service->title }}</a><br>
                                    <strong class="text-success">{{ $log->item_type }}</strong>
                                </td>
                                <td>
                                    {!! implode('<br>', $log->data) !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection