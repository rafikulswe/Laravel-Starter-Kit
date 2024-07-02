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
        <select class="select-search data-search" event="change" name="organization_id">
            <option value="">Select Organization</option>
            @foreach ($organizations as $organization)
                <option value="{{ $organization->id }}" @if ($organization->id == $organization_id) selected @endif>
                    {{ $organization->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <a href="{{ route('provider.organogram.create') }}" class="btn btn-primary float-right ml-2 add-new">Add
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
                <th>Organogram Name</th>
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
            $paginateLinks = $organograms;
        @endphp
            <tbody>
                @if (count($organograms) > 0)
                    @foreach ($organograms as $key => $organogram)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $organogram->organization_name }}</td>
                            <td>{{ $organogram->name }}</td>
                            <td>{{ $organogram->short_name }}</td>
                            <td>{{ $organogram->country_name }}</td>
                            <td>{{ $organogram->division_name }}</td>
                            <td>{{ $organogram->district_name }}</td>
                            <td>{{ $organogram->thana_name }}</td>
                            <td>{{ $organogram->mobile }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <a href="{{ route('provider.organogram.edit', [$organogram->id]) }}"
                                        class="list-icons-item text-info"><i class="icon-pencil7"></i></a>

                                    <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                            delete-link="{{ route('provider.organogram.destroy', [$organogram->id]) }}">@csrf</i></a>
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
