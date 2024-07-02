<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="30%">Field Name</th>
                            <th width="5%">:</th>
                            <th width="65%">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Code</td>
                            <td>:</td>
                            <td>{{ $roleGroup->code }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $roleGroup->name }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td>{{ $roleGroup->description }}</td>
                        </tr>
                        <tr>
                            <td>As Default</td>
                            <td>:</td>
                            <td>@if ($roleGroup->used_as_default == 1) Yes @else No @endif </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

