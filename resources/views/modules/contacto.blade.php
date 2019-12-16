@extends('crudbooster::admin_template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
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
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-phone'></i> Contacto
                </div>
                <form role="form" method="POST" action="/admin/contact">
                    {{ csrf_field() }}
                    <div class="panel-body">

                        <!-- select -->
                        <div class="form-group">
                            <label>Asunto</label>
                            <select class="form-control" required name="subject">
                                <option value="" selected disabled>Seleccione uno</option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->name}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Mensaje</label>
                            <textarea class="form-control" rows="3" placeholder="Ingrese el mensaje"
                                      required name="message"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection