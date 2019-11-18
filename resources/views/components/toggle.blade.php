@if(CRUDBooster::myPrivilegeId()== $cms_privileges_id)
    @if(CRUDBooster::getCurrentMethod() == 'getAdd')
        <input class="checkboxtoggle" name="{{$field}}" type="checkbox" @if($checked) checked @else @endif  data-toggle="toggle" data-size="small" value="{{ $checked ? '1' : '0' }}">
    @else
        <input class="checkboxtoggle" name="{{$field}}" type="checkbox" @if($row->$field) checked @else @endif  data-toggle="toggle" data-size="small" value="{{ $row->$field }}">
    @endif
@else
    @if($row->field)
        <label class="label label-success">SI</label>
    @else
        <label class="label label-danger">NO</label>
    @endif
@endif