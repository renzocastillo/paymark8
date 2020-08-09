@extends('layout')
@section('content')
<section id="featured">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2> {{ CRUDBooster::getSetting('maintenance_title') }} </h2>
            </div>
            <div class="col-sm-12">
                <p> {!! CRUDBooster::getSetting('maintenance_text') !!} </p>
            </div>
        </div>
    </div>
@endsection