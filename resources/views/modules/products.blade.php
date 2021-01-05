@extends('crudbooster::admin_template')
@section('content')
    @component('components.checkout',
    [
        'itemType'=>'2'
    ]) 
    @endcomponent
    <div class="container-fluid">
        <div class="row buttons-carousel">
            <a href="{{CRUDBooster::mainpath("")}}"
               class="btn btn-primary {{  Request::get('category_id') ? "" : "active" }}">Todos</a>
               <a href="{{CRUDBooster::mainpath("?my_favourite=0")}}"
           class="btn btn-primary {{  Request::get('my_favourite')==0 ? "" : "active" }}">My Favorite Courses</a>
            @foreach($categories as $category)
                {{--<img src="{{url($category->logo)}}"/>--}}
                <a href="{{CRUDBooster::mainpath("?&category_id=".$category->id)}}"
                   class="btn btn-primary {{Request::get('category_id')==$category->id ? "active" : "" }}">{{$category->nombre}}</a>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <ul class="products list-unstyled row">
                        @foreach($products as $product)
                            @component('components.curso',
                            [
                                'course'=>$product,
                            ])
                            @endcomponent
                        @endforeach
                    </ul>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="{{$products->url(1)}}">«</a></li>
                        @for($i=1; $i<=$products->lastPage(); $i++)
                            <li class="{{ $products->currentPage()==$i?'active':''}}"><a
                                        href="{{$products->url($i)}}">{{$i}}</a>
                            </li>
                        @endfor
                        @if($products->lastPage()>1)
                            <li><a href="{{$products->url($products->lastPage())}}">»</a></li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
