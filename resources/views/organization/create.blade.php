@extends('layouts.default')
@section('content')
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
                    <form id="organizationForm" class="from-prevent-multiple-submits"
                        action="{{ route('provider.organization.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-3">
                            <div class="row">
                                <div class="col-sm-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="country_id">Country <span class="text-danger">*</span></label>
                                        <select id="country_id" name="country_id" class="form-control select-search" data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="division_id">Division <span class="text-danger">*</span></label>
                                        <select id="division_id" name="division_id" class="form-control select-search" data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="district_id">District <span class="text-danger">*</span></label>
                                        <select id="district_id" name="district_id" class="form-control select-search district-div" data-fouc>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="thana_id">Thana <span class="text-danger">*</span></label>
                                        <select id="thana_id" name="thana_id" class="form-control select-search thana-div" data-fouc>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" maxlength="50" class="form-control maxlength-options" placeholder="Enter Your Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="short_name">Short Name <span class="text-danger">*</span></label>
                                        <input type="text" id="short_name" name="short_name" maxlength="50" class="form-control maxlength-options" placeholder="Enter Your Nick Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile </label>
                                        <input type="text" id="mobile" name="mobile" maxlength="32" class="form-control maxlength-options" placeholder="Enter Your Mobile number">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" maxlength="64" class="form-control maxlength-options" placeholder="Enter Your Email Address">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="d-flex justify-content-end align-items-center">
                            <a id="back" href="{{ route('provider.organization.index') }}" class="btn btn-light ml-3">Back To List <i class="fas fa-backward ml-2"></i></a>
                            <button id="submit" class="btn btn-success ml-3 form-submit-btn">Submit <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

        // DIVISION WISE DISTRICT
        $('#organizationForm').on('change', '#district_id', function() {
            let district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{route('provider.getUpazilaDropdown')}}",
                    type: "GET",
                    data: {district_id: district_id},
                    success: function (response) {
                        $("#organizationForm .thana-div").html(response);
                    }
                });
            }
        });
    })
</script>
@endpush
