<div class="content">
    <div class="card">

        <div class="collapse show">
            <div class="card-body">
                <form id="myform" action="{{ route('provider.roleGroup.update', [$roleGroupInfo->id]) }}" method="POST"
                    class="from-prevent-multiple-submits" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <fieldset class="mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" id="code" name="code" maxlength="50"
                                        value="{{ $roleGroupInfo->code }}" class="form-control maxlength-options"
                                        placeholder="Enter Your Code" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" maxlength="50"
                                        value="{{ $roleGroupInfo->name }}" class="form-control maxlength-options"
                                        placeholder="Enter Your Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select placeholder="fafa" multiple="multiple" name="role_ids[]"
                                        class="form-control select-search" data-fouc required>
                                        @if ($roles)
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}" @if (in_array($role->id, $roleIds)) selected @endif>
                                                    {{ $role->name }}</option>
                                                    
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <label for="description">Description</label>
                                <textarea rows="3" cols="3" maxlength="225" name="description" class="form-control maxlength-textarea"
                                    placeholder="This textarea has a limit of 225 chars.">{{ $roleGroupInfo->description }}</textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();
    });
</script>
