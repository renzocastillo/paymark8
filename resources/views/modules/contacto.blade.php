@extends('crudbooster::admin_template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-comments'></i> Indícanos tu consulta
                </div>
                <form role="form" method="POST" action="/admin/contacto">
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
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-envelope'></i> Medios de Contacto
                </div>
                <div class="panel-body">
                    @foreach($datos_de_contacto as $dato)
                        @if(!empty($dato->content))
                            <label class="label-setting">{{ $dato->label }} : &nbsp;</label><span>{{$dato->content}}</span>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection