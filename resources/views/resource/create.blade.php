<div class="content">
    <div class="card">
        <div class="card-body" id="modal-container">
            <form id="myform" class="from-prevent-multiple-submits" action="{{ route('provider.resource.store') }}"
                method="POST">
                @csrf
                <fieldset class="mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Resource</label>
                                <select id="resource_type" name="resource_type" class="form-control select" data-fouc>
                                    <option value="">Select</option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" id="display_name" name="display_name" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Display Name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="resource_url">Resource URL</label>
                                <input type="url" id="resource_url" name="resource_url" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Resource URL"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="controller_name">Controller Name</label>
                                <input type="text" id="controller_name" name="controller_name" maxlength="50"
                                    class="form-control maxlength-options" placeholder="Enter Your Controller Name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Sort Order</label>
                                <select id="sort_order" name="sort_order" class="form-control select" data-fouc>
                                    <option value="">Select</option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".select").select2({
        dropdownParent: "#modal-container"
    });
</script>
