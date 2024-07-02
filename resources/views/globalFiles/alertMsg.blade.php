@if (session('msgType'))
    @if(session('msgType') == 'danger')
        <div id="msgDiv" class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
        </div>
    @else
    <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
    </div>
    @endif
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-styled-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Opps!</span> {{ $error }}.
    </div>
    @endforeach
@endif