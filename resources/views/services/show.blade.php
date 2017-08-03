@extends('layouts.master')

<!-- About Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>{{ $service->title }}</h2>
                <hr class="star-light">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr>
                        <th>Aktywna</th>
                        <td>
                            @if ($service->is_active)
                                <span class="glyphicon glyphicon-ok"></span>
                            @else
                                <span class="glyphicon glyphicon-remove"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Url</th>
                        <td>{{ $service->url }}</td>
                    </tr>
                    <tr>
                        <th>Metoda</th>
                        <td>{{ $service->valid_method }}</td>
                    </tr>
                    <tr>
                        <th>Oczekiwany rezultat</th>
                        <td>{{ $service->expects }}</td>
                    </tr>
                </table>

                <h3>Log</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Data utworzenia</th>
                        <th>Ile czasu temu</th>
                        <th class="text-center">Rezultat</th>
                        <th>Komunikat</th>
                    </tr>

                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                @if ($log->check_result)
                                    <span class="glyphicon glyphicon-ok"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove"></span>
                                @endif
                            </td>
                            <td>{{ $log->message }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>