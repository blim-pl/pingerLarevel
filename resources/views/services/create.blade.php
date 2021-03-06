@extends('layouts.master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Nowa usługa</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    @include('layouts.partials.forms.errors')

                    <form method="post" action="{{ route('services.store') }}">
                        <div class="form-group">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="is_active" value="0" />
                                        <input type="checkbox" name="is_active" value="1" class="checkbox" @if(old('is_active')) checked="checked" @endif /> Aktywna
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title">Tytuł</label>
                                <input type="text" class="form-control" name="title" placeholder="" value="{{ old('title') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" name="url" placeholder="" value="{{ old('url') }}" required />
                            </div>

                            <div class="form-group">
                                <label>Metoda kontroli</label>
                                <select name="valid_method" class="form-control">
                                    <option value=""> - </option>
                                    @foreach($validationMethods as $method)
                                        <option value="{{ $method['value'] }}" @if(old('valid_method') == $method['value']) selected="selected" @endif>
                                            {{ $method['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Oczekiwania wartość</label>
                                <input type="text" class="form-control" name="expects" value="{{ old('expects') }}" />
                            </div>

                            <div class="form-group">
                                <label>Adresy email do powiadomień (więcej niż 1 po przecinku)</label>
                                <input type="text" class="form-control" name="emails" value="{{ old('emails') }}" placeholder="adresy email" />
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Zapisz</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection