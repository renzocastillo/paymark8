@extends('layout')
@section('content')
    <section id="featured">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Términos y Condiciones de Uso de la
                        Plataforma {{ ucfirst(CRUDBooster::getSetting('appname')) }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!!CRUDBooster::getSetting('terminos-y-condiciones')!!}
                </div>
            </div>
        </div>
    </section>
@endsection
