@extends('layouts.master')

<!-- About Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>{{ $page->title }}</h2>
                <hr class="star-light">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>