<div class="p-3 form-inline row">
    <div class="col-md-3">
        <div class="input-group">
            <input name="search" event="enter" class="data-search form-control" id="search-input"
                value="{{ @$search }}" kl_virtual_keyboard_secure_input="on" placeholder="Search">
            <span class="input-group-btn"><button name="search" event="click" valueFrom="#search-input"
                    class="data-search btn btn-primary" type="button">Go</button></span>
        </div>
    </div>
    <div class="col-md-3">
        {{-- <select class="select-search data-search" event="change" name="role_id">
            <option value="">Select Role</option>
            @foreach ($organizations as $organization)
                <option value="{{ $organization->id }}" @if ($organization->id == $organization_id) selected @endif>
                    {{ $organization->name }}</option>
            @endforeach 
        </select> --}}
    </div>
    <div class="col-md-6">
        @include('globalFiles.perPageBox')
    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SL</th>
                <th>Type</th>
                <th>Name (EN)</th>
                <th>Division</th>
                <th>District</th>
                <th>Thana</th>
                {{-- <th class="text-center">Actions</th> --}}
            </tr>
        </thead>
        @php
            $paginateLinks = $locations;
        @endphp
        @if ($locations)
            <tbody>
                @foreach ($locations as $key => $location)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $location->location_type_id }}</td>
                        <td>{{ $location->name_en }} ({{ $location->name_bn }})</td>
                        <td>{{ @Helper::locationeName($location->division_id) }}</td>
                        <td>{{ @Helper::locationeName($location->district_id) }}</td>
                        <td>{{ @Helper::locationeName($location->thana_id) }}</td>
                        {{-- <td class="text-center">
                            <div class="list-icons">
                                <a href="{{ route('provider.location.edit', [$location->id]) }}"
                                    class="list-icons-item text-info"><i class="icon-pencil7"></i></a>

                                <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                        delete-link="{{ route('provider.location.destroy', [$location->id]) }}">@csrf</i></a>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
    <div class="row my-2 float-right">
        <div class="col-md-12 col-xs-12">
            @include('globalFiles.pagination')
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();
    });
</script>
