@extends('crudbooster::admin_template')
@section('content')
<div style="width:750px;margin:0 auto ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class='fa fa-phone'></i> {{ucfirst($page_title)}}
        </div>
        <div class="panel-body">
            @foreach($datos_de_contacto as $dato)
                <label class="label-setting">{{ $dato->label }} : &nbsp;</label><span>{{$dato->content}}</span>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection