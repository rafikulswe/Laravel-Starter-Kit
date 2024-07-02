<?php if(empty($perPageArray)) { $perPageArray = array(10, 25, 50, 100); } ?>
<label class="float-right">
    <span>
        <select name="basic-datatables_length" class="form-control input-sm" id="perPage">
            @foreach($perPageArray as $perPageVal)
            <option @if(!empty($perPage) && ($perPage==$perPageVal)) {{'selected'}} @endif value="{{$perPageVal}}">{{$perPageVal}}</option>
            @endforeach
        </select>
    </span>
</label>
