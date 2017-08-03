@extends('layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @include('layouts.partials.forms.errors')

                    <form method="post" action="/pages/{{ $page->id }}">

                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" name="title" placeholder="" value="{{ old('title', $page->title) }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="content">Alias</label>
                            <input type="text" class="form-control" name="alias" placeholder="" value="{{ old('alias', $page->alias) }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="content">Treść</label>
                            <textarea class="form-control" name="content">{{ old('content', $page->content) }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="in_menu" value="0"/>
                                    <input type="checkbox" name="in_menu" value="1" @if (old('in_menu', $page->in_menu)) checked="checked" @endif />
                                    Widoczna w menu
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection