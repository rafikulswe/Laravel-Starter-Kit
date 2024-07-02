<div class="row">
    <div class="col-sm-6 col-lg-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Scope Permissons</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="collapse show">
                <div class="card-body">
                    <div class="row">
                        @if ($scopes)
                            @foreach ($scopes as $scope)
                                <div class="col-md-6">
                                    <label class="form-check form-check-inline col-md-6">
                                        <input type="checkbox" class="form-check-input"
                                            name="scope_ids[]" value="{{ $scope->id }}" @if (in_array($scope->id, $permissions)) checked @endif><span
                                            class="form-check-label">{{ $scope->scope }}</span>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>