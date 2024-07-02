@extends('layouts.default')
@section('content')
    <!-- Basic layout-->
    @include('layouts.components.pageHeader')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"></h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="collapse show">
                <div class="card-body">
                    <form id="myform" action="{{ route('provider.organogram.update', [$organogramInfo->id]) }}" method="POST"
                        class="from-prevent-multiple-submits" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="mb-3">
                            <div class="row">

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="organization_id">Organization <span class="text-danger">*</span></label>
                                        <select id="organization_id" name="organization_id" class="form-control select-search" data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($organizations as $organization)
                                            <option value="{{ $organization->id }}" @if ($organization->id == $organogramInfo->organization_id) selected @endif>{{ $organization->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select id="country_id" name="country_id" class="form-control select-search"
                                            data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if ($country->id == $organogramInfo->country_id) selected @endif>{{ $country->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label>Division</label>
                                        <select id="division_id" name="division_id" class="form-control select-search"
                                            data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" @if ($division->id == $organogramInfo->division_id) selected @endif>{{ $division->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label>District</label>
                                        <select id="district_id" name="district_id" class="form-control select-search"
                                            data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" @if ($district->id == $organogramInfo->district_id) selected @endif>{{ $district->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label>Thana</label>
                                        <select id="thana_id" name="thana_id" class="form-control select-search" data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($upazilas as $upazila)
                                            <option value="{{ $upazila->id }}" @if ($upazila->id == $organogramInfo->thana_id) selected @endif>{{ $upazila->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $organogramInfo->name }}" maxlength="50"
                                            class="form-control maxlength-options" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="short_name">Short Name</label>
                                        <input type="text" id="short_name" name="short_name" value="{{ $organogramInfo->short_name }}" maxlength="50"
                                            class="form-control maxlength-options" placeholder="Enter Your Short Name">
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" value="{{ $organogramInfo->mobile }}" maxlength="32"
                                            class="form-control maxlength-options" placeholder="Enter Your Mobile number">
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{ $organogramInfo->email }}" maxlength="64"
                                            class="form-control maxlength-options" placeholder="Enter Your Email Address">
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <div class="d-flex justify-content-end align-items-center">

                            <a id="back" href="{{ route('provider.organogram.index') }}" class="btn btn-light ml-3">Back To List
                                <i class="fas fa-backward ml-2"></i></a>
                            <button id="submit" class="btn btn-success ml-3 form-submit-btn">Submit <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic layout -->
@endsection


@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        // DIVISION WISE DISTRICT
        $('#organizationForm').on('change', '#division_id', function() {
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{route('provider.getDistrictDropdown')}}",
                    type: "GET",
                    data: {division_id: division_id},
                    success: function (response) {
                        $("#organizationForm .district-div").html(response);
                    }
                });
            }
        });
    })
</script>
@endpush

