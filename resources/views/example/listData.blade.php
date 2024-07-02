<div class="p-3 form-inline row">
    <div class="col-md-6">
        <div class="input-group">
            <input name="search" event="enter" class="data-search form-control" id="search-input"
                value="{{ @$search }}" kl_virtual_keyboard_secure_input="on" placeholder="Search">
            <span class="input-group-btn"><button name="search" event="click" valueFrom="#search-input"
                    class="data-search btn btn-primary" type="button">Go</button></span>
        </div>
    </div>
    <div class="col-md-6">

        <a href="#" modal-type="create" modal-title="Create Example" modal-size="large" modal-class=""
            selector="AddRoleGroup" modal-link="{{ route('provider.example.create') }}"
            class="btn btn-primary float-right ml-2 add-new open-modal">Add New</a>

        @include('globalFiles.perPageBox')


    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover data-list">
        <thead>
            <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @php
            $paginateLinks = $examples;
        @endphp
        <tbody>
            @if (count($examples) > 0)
                @foreach ($examples as $key => $example)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>{{ $example->title }}</td>
                        <td>{{ $example->description }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a href="#" modal-title="View Role" modal-type="show" modal-size="large"
                                    modal-class="" selector="ViewRole"
                                    modal-link="{{ route('provider.example.show', [$example->id]) }}"
                                    class="list-icons-item text-success open-modal"><i class="icon-info22"></i></a>

                                <a href="#" modal-title="Update Role" modal-type="update" modal-size="large"
                                    modal-class="" selector="UpdateRole"
                                    modal-link="{{ route('provider.example.edit', [$example->id]) }}"
                                    class="list-icons-item text-info open-modal"><i class="icon-pencil7"></i></a>

                                <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                        delete-link="{{ route('provider.example.destroy', [$example->id]) }}">@csrf</i></a>
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
