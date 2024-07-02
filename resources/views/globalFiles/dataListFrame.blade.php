<div class="card-header header-elements-inline" style="border-bottom: 1px solid #ddd;">
    <h6 class="card-title">{{ $tableTitle }}</h6>
    <div class="header-elements">
        <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
            <a class="list-icons-item" data-action="reload"></a>
            <a class="list-icons-item" data-action="remove"></a>
        </div>
    </div>
</div>

<div class="collapse show panel-laod" load-url="{{ $loadUrl }}">
    <div class="data-list"></div>
</div>
