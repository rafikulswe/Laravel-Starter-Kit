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
        <a href="{{ route('provider.organization.create') }}" class="btn btn-primary float-right ml-2 add-new">Add
            New</a>
        @include('globalFiles.perPageBox')
    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover ">
        <thead>
            <tr>
                <th>SL</th>
                <th>Organization Name</th>
                <th>Short Name</th>
                <th>Country</th>
                <th>Division</th>
                <th>District</th>
                <th>Thana</th>
                <th>Mobile</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @php
            $paginateLinks = $organizations;
        @endphp
            <tbody>
                @if (count($organizations) > 0)
                    @foreach ($organizations as $key => $organization)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $organization->name }}</td>
                            <td>{{ $organization->short_name }}</td>
                            <td>{{ $organization->country_name }}</td>
                            <td>{{ $organization->division_name }}</td>
                            <td>{{ $organization->district_name }}</td>
                            <td>{{ $organization->thana_name }}</td>
                            <td>{{ $organization->mobile }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <a href="{{ route('provider.organization.edit', [$organization->id]) }}"
                                        class="list-icons-item text-info"><i class="icon-pencil7"></i></a>

                                    <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                            delete-link="{{ route('provider.organization.destroy', [$organization->id]) }}">@csrf</i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">No Data Found</td>
                    </tr>
                @endif
            </tbody>
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
