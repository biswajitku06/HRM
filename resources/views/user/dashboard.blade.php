@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-6">
                    <section class="card card-featured-left card-featured-tertiary mb-3">
                        <div class="card-body">

                        </div>
                    </section>
                </div>
                <div class="col-xl-6">
                    <section class="card card-featured-left card-featured-tertiary mb-3">
                        <div class="card-body">

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection