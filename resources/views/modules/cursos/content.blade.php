@extends('crudbooster::admin_template')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive padding">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 col-xs-12 pleft" >
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/BcUeUs72O7Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12 pleft overflow-modulos" style="overflow-y:scroll; height:350px;" >
                        @foreach($course->modules as $module)
                            <div class="box box-primary {{ $module->id == $open_module ? '' : 'collapsed-box'}} box-solid slim-margin" style="margin-bottom: 10px;">
                                <div class="box-header with-border">
                                <h3 class="box-title">{{ $module->title }}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <ul class="nav nav-stacked">
                                        @foreach($module->module_videos as $video)
                                            <li><i class="fa fa-play-circle" aria-hidden="true"></i> {{  $video->title }}</a></li>
                                        @endforeach
                                        @foreach($module->module_files as $file)
                                            <li><a href={{ $file->url }}><i class="fa fa-download" aria-hidden="true"></i>{{  $file->url }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection