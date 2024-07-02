@extends('layouts.default')

@section('content')
    @include('layouts.components.pageHeader')
    <!-- Content area -->
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
                    <div style="text-align: center; padding: 40px;">
                        <div style="border-bottom: 1px solid #dddddd;">
                            <span style="font-size: 18px;">Hi! <strong
                                    style="font-size: 24px; letter-spacing: 2px;">{{ Auth::user()->name }}</strong></span>
                        </div>
                        <h6>Welcome to Admin Panel</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection
