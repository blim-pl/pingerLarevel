@extends('layouts.master')

@section('content')

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="{{ route('pages.create') }}" class="portfolio-link" title="Dodaj stronę">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cabin.png" class="img-responsive" alt="Cabin">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="{{ route('services.create') }}" class="portfolio-link" title="Dodaj usługę">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cake.png" class="img-responsive" alt="Slice of cake">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="{{ route('services.index') }}" class="portfolio-link" title="Usługi">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/circus.png" class="img-responsive" alt="Circus tent">
                    </a>
                </div>
                {{--<div class="col-sm-4 portfolio-item">--}}
                {{--<a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">--}}
                {{--<div class="caption">--}}
                {{--<div class="caption-content">--}}
                {{--<i class="fa fa-search-plus fa-3x"></i>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<img src="img/portfolio/game.png" class="img-responsive" alt="Game controller">--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4 portfolio-item">--}}
                {{--<a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">--}}
                {{--<div class="caption">--}}
                {{--<div class="caption-content">--}}
                {{--<i class="fa fa-search-plus fa-3x"></i>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<img src="img/portfolio/safe.png" class="img-responsive" alt="Safe">--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4 portfolio-item">--}}
                {{--<a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">--}}
                {{--<div class="caption">--}}
                {{--<div class="caption-content">--}}
                {{--<i class="fa fa-search-plus fa-3x"></i>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<img src="img/portfolio/submarine.png" class="img-responsive" alt="Submarine">--}}
                {{--</a>--}}
                {{--</div>--}}
            </div>
            @if($pages)
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped">

                            <tr>
                                <th>Tytuł</th>
                                <th>Alias</th>
                                <th>W menu</th>
                                <th colspan="2" class="text-center">Akcja</th>
                            </tr>

                            @foreach ($pages as $page)

                                <tr>
                                    <td>
                                        <a href="{{ route('pages.show', $page->id) }}">{{ $page->title }}</a>
                                    </td>
                                    <td>{{ $page->alias }}</td>
                                    <td>
                                        @if ($page->in_menu)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                            <span class="glyphicon glyphicon-remove"></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary"
                                           title="Edytuj">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route('pages.destroy', $page->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
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
            @endif
        </div>
    </section>

@endsection