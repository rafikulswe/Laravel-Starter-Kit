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
                    <form id="myform" class="from-prevent-multiple-submits" action="{{ route('provider.scope.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-3">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Resource</label>
                                        <select id="resource_id" name="resource_id" class="form-control select-search"
                                            data-fouc required>
                                            <option value="">Select</option>
                                            @if ($resources)
                                                @foreach ($resources as $resource)
                                                    <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-lg-2">
                                    <div class="form-group">
                                        <label for="scope">Scope</label>
                                        <input type="text" id="scope" name="scope" maxlength="50"
                                            class="form-control maxlength-options" placeholder="Enter Your Scope Name"
                                            required>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="display_name">Display Name</label>
                                        <input type="text" id="display_name" name="display_name" maxlength="50"
                                            class="form-control maxlength-options" placeholder="Enter Your Display Name">
                                    </div>
                                </div>

                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label>HTTP Method Name</label>
                                        <select id="http_method" name="http_method" class="form-control select-search"
                                            data-fouc required>
                                            <option value="">Select</option>
                                            <option value="get">GET</option>
                                            <option value="post">POST</option>
                                            <option value="put">PUT</option>
                                            <option value="delete">DELETE</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="action_name">Action Name</label>
                                        <input type="text" id="action_name" name="action_name" maxlength="32"
                                            class="form-control maxlength-options" placeholder="Enter Your Action Name">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="url">URL Address</label>
                                        <input type="text" id="url" name="url" maxlength="64"
                                            class="form-control maxlength-options" placeholder="Enter Your URL Address">
                                    </div>
                                </div>
                            </div>


                        </fieldset>
                        <div class="d-flex justify-content-end align-items-center">
                            <button id="reset" type="reset" class="btn btn-danger">Reset <i
                                    class="icon-reload-alt ml-2"></i></button>
                            <a id="back" href="{{ route('provider.scope.index') }}" class="btn btn-light ml-3">Back
                                To
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
@endsection
