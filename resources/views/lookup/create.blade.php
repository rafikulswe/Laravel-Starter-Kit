<div class="content">
    <div class="card">
        <div class="card-body">
            <form id="myform" class="from-prevent-multiple-submits" action="{{ route('provider.lookup.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="mb-3">
                    <div class="row">

                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Type</label>
                                <select id="type" name="type" class="form-control select-search" data-fouc
                                    required>
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="key">Key</label>
                                <input type="text" id="key" name="key" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Key" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="value">Value</label>
                                <input type="text" id="value" name="value" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Value" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea rows="1" cols="3" maxlength="225" name="description" class="form-control maxlength-textarea"
                                    placeholder="This textarea has a limit of 225 chars."></textarea>
                            </div>
                        </div>

                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();

    });
</script>
