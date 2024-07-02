@extends('layouts.default')
@section('content')
    @include('layouts.components.pageHeader')
    <div class="content">
        <div class="card">
            @include('globalFiles.urlParaMeter')
            @php
                $tableTitle = 'Organogram List';
                $loadUrl = 'organogramListData';
            @endphp
            @include('globalFiles.dataListFrame')
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            loadDataTable($(this));
        });
    </script>
@endpush
