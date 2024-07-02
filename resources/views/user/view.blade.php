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
                            <td>Organization</td>
                            <td>:</td>
                            <td>{{ $user->organization_id }}</td>
                        </tr>
                        <tr>
                            <td>Organogram</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>:</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();

    });
</script>
