@extends('layouts.default')
@section('content')
    <div class="content">
        <div class="card">
            @include('globalFiles.urlParaMeter')
            @php
                $tableTitle = 'Example List';
                $loadUrl = 'exampleListData';
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
