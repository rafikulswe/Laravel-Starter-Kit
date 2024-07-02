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
        <select class="select-search data-search" event="change" name="is_default">
            <option value="2" @if ($is_default == 2) selected @endif>All</option>
            <option value="1" @if ($is_default == 1) selected @endif>Default</option>
            <option value="0" @if ($is_default == 0) selected @endif>Not Default</option>
        </select>
    </div>
    <div class="col-md-6">

        <a href="#" modal-type="create" modal-title="Create Role" modal-size="large" modal-class="" selector="AddRoleGroup"
        modal-link="{{ route('provider.role.create') }}"
        class="btn btn-primary float-right ml-2 add-new open-modal">Add New</a>

        @include('globalFiles.perPageBox')


    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover data-list">
        <thead>
            <tr>
                <th>SL</th>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Is Default</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @php
            $paginateLinks = $roles;
        @endphp
        <tbody>
            @if (count($roles) > 0)
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>{{ $role->code }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <label class="custom-control custom-switch" id="updateStatus"
                                decision-link="{{ route('provider.roleSetDefault', ['roleId' => $role->id]) }}"
                                alert-text="You want to change this?" confirmBtn-text="Yes, Change It!">
                                @csrf
                                <input type="checkbox" class="custom-control-input update-checkbox"
                                    @if ($role->used_as_default == 1) checked @endif>
                                <label class="custom-control custom-switch" id="updateStatus"
                                    decision-link="{{ route('provider.roleSetDefault', ['roleId' => $role->id]) }}"
                                    alert-text="You want to change this?" confirmBtn-text="Yes, Change It!">
                                    @csrf
                                    <input type="checkbox" class="custom-control-input update-checkbox"
                                        @if ($role->used_as_default == 1) checked @endif>
                                    <span class="custom-control-label p-0"></span>
                                </label>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a href="#" modal-title="View Role" modal-type="show" modal-size="large" modal-class=""
                                    selector="ViewRole" modal-link="{{ route('provider.role.show', [$role->id]) }}"
                                    class="list-icons-item text-success open-modal"><i class="icon-eye"></i></a>

                                <a href="#" modal-title="Update Role" modal-type="update" modal-size="large" modal-class="" selector="UpdateRole"
                                modal-link="{{ route('provider.role.edit', [$role->id]) }}"
                                    class="list-icons-item text-info open-modal"><i class="icon-pencil7"></i></a>

                                <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                        delete-link="{{ route('provider.role.destroy', [$role->id]) }}">@csrf</i></a>
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
