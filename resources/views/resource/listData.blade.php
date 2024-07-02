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
        <a modal-type="create" modal-size="large" modal-class="" selector="AddResource"
            modal-link="{{ route('provider.resource.create') }}"
            class="btn btn-primary float-right ml-2 add-new open-modal">Add New</a>
        @include('globalFiles.perPageBox')
    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SL</th>
                <th>Type</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Resource URL</th>
                <th>Controller Name</th>
                <th>Sort Order</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @php
            $paginateLinks = $resources;
        @endphp
        @if ($resources)
            <tbody>
                @foreach ($resources as $key => $resource)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $resource->resource_type == 1 ? "Resource" : "Single"  }}</td>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->display_name }}</td>
                        <td>{{ $resource->resource_url }}</td>
                        <td>{{ $resource->controller_name }}</td>
                        <td>{{ $resource->sort_order == 1 ? "True" : "False" }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a modal-type="create" modal-size="large" modal-class="" selector="AddResource"
                                modal-link="{{ route('provider.resource.edit', [$resource->id]) }}"
                                    class="list-icons-item text-info open-modal"><i class="icon-pencil7"></i></a>

                                <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                        delete-link="{{ route('provider.resource.destroy', [$resource->id]) }}">@csrf</i></a>
                            </div>
                        </td>
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
