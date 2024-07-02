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
                    <form id="myform" action="{{ route('provider.user.update', [$user->id]) }}" method="POST"
                        class="from-prevent-multiple-submits" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="mb-3">
                            <div class="row">

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Organization</label>
                                        <select id="organization_id" name="organization_id" class="form-control select-search" data-fouc>
                                            <option value="">Select</option>
                                            @foreach ($organizations as $organization)
                                            <option value="{{ $organization->id }}" @if($organization->id == $user->organization_id) selected @endif>{{ $organization->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Organogram</label>
                                        <select placeholder="Select" multiple="multiple" id="organogram_ids" name="organogram_ids[]" class="form-control select-search" data-fouc required>
                                            @foreach ($organograms as $organogram)
                                            <option value="{{ $organogram->id }}" @if(in_array($organogram->id, $user->organogram_ids)) selected @endif>{{ $organogram->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Role Group</label>
                                        <select id="role_group_id" name="role_group_id" class="form-control select-search" data-fouc
                                            required>
                                            @foreach ($roleGroups as $group)
                                                <option value="{{ $group->id }}" @if($group->id == $user->role_group_id) selected @endif>{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" maxlength="50"
                                            class="form-control maxlength-options" value="{{ $user->name }}"
                                            placeholder="Enter Your Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email" maxlength="100"
                                            class="form-control maxlength-options" value="{{ $user->email }}"
                                            placeholder="Enter Your Email Address" required>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" id="phone" name="phone" maxlength="11"
                                            class="form-control maxlength-options" value="{{ $user->phone }}"
                                            placeholder="Enter Your Phone Number">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" maxlength="30"
                                            class="form-control maxlength-options" autocomplete="off"
                                            placeholder="Enter Your Password">
                                    </div>
                                </div>

                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                            </div>


                        </fieldset>
                        <div class="d-flex justify-content-end align-items-center">
                            <button id="reset" type="reset" class="btn btn-danger">Reset <i
                                    class="icon-reload-alt ml-2"></i></button>
                            <a id="back" href="{{ route('provider.user.index') }}" class="btn btn-light ml-3">Back To
                                List
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
