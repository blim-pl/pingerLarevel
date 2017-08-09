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
                            <th class="text-center">Aktywna</th>
                            <th>Ost. aktywność</th>
                            <th colspan="3" class="text-center">Akcje</th>
                        </tr>
                        @foreach ($services as $service)
                            <tr>
                                <td>
                                    <a href="{{ route('services.show', $service->id) }}">
                                        {{ $service->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $service->url }}
                                </td>
                                <td class="text-center">
                                    @if ($service->is_active)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </td>
                                <td>
                                    <?php $lastLog = $service->lastLog(); ?>

                                    @if($lastLog)
                                        @if ($lastLog->result)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                            <span class="glyphicon glyphicon-remove"></span>
                                        @endif
                                        &nbsp;
                                        [{{ $lastLog->created_at->diffForHumans() }}]
                                    @else
                                        ---
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary" title="Edytuj">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('checks.show', $service->id) }}" class="btn btn-success" title="Uruchom">
                                        <span class="glyphicon glyphicon-play"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('services.destroy', $service->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}

                                        <button class="btn btn-danger" type="submit">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                                </td>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection