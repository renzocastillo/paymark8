@extends('crudbooster::admin_template')
@section('content')
<ul class="list-unstyled video-list-thumbs row">
    @foreach($tutoriales as $tutorial)
	<li class="col-lg-4 col-sm-12">
        <div class="panel panel-default">
                <div class="panel-heading"> {{$tutorial->titulo}}</div>
        @if($tutorial->descripcion)
        <div class="panel-body">{{$tutorial->descripcion}}</div>
        @else
            <div class="panel-body"><br></div>
        @endif
       <div class="iframe-container">
            {!! $tutorial->html_youtube !!}
        </div>
        @if(CRUDBooster::myPrivilegeid()==2)
            <div class="panel-footer">
                <a class="btn btn-success btn-edit" title="Editar" href="{{CRUDBooster::mainpath("edit/".$tutorial->id."?return_url=".urlencode(Request::fullUrl()))}}"><i class="fa fa-pencil"></i> Editar Tutorial</a></span>
            </div>
        @endif
        </div>    
    </li>
    @endforeach
</ul>
@endsection