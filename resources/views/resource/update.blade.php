<div class="content">
    <div class="card">

        <div class="collapse show">
            <div class="card-body">
                <form id="myform" action="{{ route('provider.resource.update', [$resource->id]) }}" method="POST"
                    class="from-prevent-multiple-submits" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset class="mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Resource</label>
                                    <select id="resource_type" name="resource_type" class="form-control select  select-search"
                                        data-fouc>
                                        <option value="">Select</option>
                                        <option value="1" @if($resource->resource_type == 1) selected @endif>True</option>
                                        <option value="0" @if($resource->resource_type == 0) selected @endif>False</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" maxlength="50" value="{{$resource->name}}"
                                        class="form-control maxlength-options" placeholder="Enter Your Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="display_name">Display Name</label>
                                    <input type="text" id="display_name" name="display_name" maxlength="50" value="{{$resource->display_name}}"
                                        class="form-control maxlength-options" placeholder="Enter Your Display Name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="resource_url">Resource URL</label>
                                    <input type="url" id="resource_url" name="resource_url" maxlength="50" value="{{$resource->resource_url}}"
                                        class="form-control maxlength-options" placeholder="Enter Your Resource URL"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="controller_name">Controller Name</label>
                                    <input type="text" id="controller_name" name="controller_name" maxlength="50" value="{{$resource->controller_name}}"
                                        class="form-control maxlength-options" placeholder="Enter Your Controller Name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <select id="sort_order" name="sort_order" class="form-control select-search" data-fouc>
                                        <option value="">Select</option>
                                        <option value="1" @if($resource->sort_order == 1) selected @endif>True</option>
                                        <option value="0" @if($resource->sort_order == 0) selected @endif>False</option>
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
