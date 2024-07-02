@extends('layouts.default')
@section('content')
    @include('layouts.components.pageHeader')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h4 class="card-title">Permissions</h4>
                <div class="header-elements">
                    <div class="list-icons">
                        {{-- <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a> --}}
                    </div>
                </div>
            </div>
            <div class=" show">
                <div class="card-body">
                    <form id="permissionForm" class="from-prevent-multiple-submits"
                        action="{{ route('provider.permission.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-3">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        {{-- <label>Role Group</label> --}}
                                        <select id="role_id" name="role_id" class="form-control select-search" data-fouc
                                            required>
                                            <option value="">Select Role</option>
                                            @if ($roles)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-4 col-lg-4">
                                    <button type="button" class="btn btn-primary">Load Permission</button>
                                </div> --}}

                            </div>
                            <div id="load_permission">
                                
                            </div>
                        </fieldset>
                        <div class="d-flex justify-content-end align-items-center">
                            <a id="back" href="{{ route('provider.permission.index') }}"
                                class="btn btn-light ml-3">Back To List <i class="fas fa-backward ml-2"></i></a>
                            <button id="submit" class="btn btn-success ml-3 form-submit-btn">Submit <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // DIVISION WISE DISTRICT
            $('#permissionForm').on('change', '#role_id', function() {
                let role_id = $(this).val();
                console.log(role_id);
                if (role_id) {
                    $.ajax({
                        url: "{{ route('provider.getLoadPermission') }}",
                        type: "GET",
                        data: {
                            role_id: role_id
                        },
                        success: function(response) {
                            $("#permissionForm #load_permission").html(response);
                        }
                    });
                }
            });

            
        })
    </script>
@endpush
