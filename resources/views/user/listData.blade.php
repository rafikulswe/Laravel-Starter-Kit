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
        <select class="select-search data-search" event="change" name="role_id">
            <option value="">Select Role</option>
            @foreach ($roleGroups as $group)
                <option value="{{ $group->id }}" @if ($group->id == $role_group_id) selected @endif>
                    {{ $group->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <a href="{{ route('provider.user.create') }}" class="btn btn-primary float-right ml-2 add-new">Add New</a>
        @include('globalFiles.perPageBox')
    </div>
</div>

<div class="card-body">
    <table id="myTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SL</th>
                <th>Organization</th>
                <th>Organograms</th>
                <th>Role</th>
                <th>name</th>
                <th>Email</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @php
            $paginateLinks = $users;
        @endphp
        @if ($users)
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->organizationName }}</td>
                        <td></td>
                        <td>{{ $user->roleName }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a modal-title="View User" modal-type="show" modal-size="large" modal-class=""
                                    selector="ViewUser" modal-link="{{ route('provider.user.show', [$user->id]) }}"
                                    class="list-icons-item text-success open-modal"><i class="icon-eye"></i></a>

                                <a href="{{ route('provider.user.edit', [$user->id]) }}"
                                    class="list-icons-item text-info"><i class="icon-pencil7"></i></a>

                                <a href="#" class="list-icons-item text-danger"><i class="delete icon-bin"
                                        delete-link="{{ route('provider.user.destroy', [$user->id]) }}">@csrf</i></a>
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
