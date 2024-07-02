
<div class="content">
    <div class="card">

        <div class="collapse show">
            <div class="card-body">
                <form id="myform" action="{{ route('provider.role.update', [$role->id]) }}" method="POST"
                    class="from-prevent-multiple-submits">
                    @csrf
                    @method('PUT')

                    <fieldset class="mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="code">Code <span class="text-danger">*</span></label>
                                    <input type="text" id="code" name="code" maxlength="80"
                                        class="form-control maxlength-options" value="{{ $role->code }}"
                                        placeholder="Enter The Code" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">

                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" maxlength="50"
                                        class="form-control maxlength-options" value="{{ $role->name }}"
                                        placeholder="Enter Your Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="details">Details</label>
                                    <textarea rows="1" cols="3" maxlength="225" name="description" class="form-control maxlength-textarea"
                                        placeholder="This textarea has a limit of 225 chars.">{{ $role->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Default</label>
                                    <select id="used_as_default" name="used_as_default" class="form-control select-search"
                                        data-fouc>
                                        <option value="1" @if ($role->used_as_default == 1) selected @endif>Yes</option>
                                        <option value="0" @if ($role->used_as_default == 0) selected @endif>No</option>
                                    </select>
                                </div>
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
